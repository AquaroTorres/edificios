<?php

namespace App\Filament\Clusters\Members\Resources\Users\Schemas;

use App\Enums\Gender;
use App\Enums\MembershipStatus;
use App\Enums\RowPosition;
use App\Filament\Forms\Components\SignaturePad;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información Personal')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('run')
                            ->label('RUN')
                            ->unique(ignoreRecord: true)
                            ->nullable()
                            ->maxLength(12)
                            ->placeholder('12345678-9'),
                        DatePicker::make('birth_date')
                            ->label('Fecha de nacimiento')
                            ->nullable(),
                        Select::make('gender')
                            ->label('Sexo')
                            ->options(Gender::class)
                            ->nullable(),
                        Textarea::make('health_background')
                            ->label('Antecedentes de salud')
                            ->nullable()
                            ->rows(3)
                            ->columnSpan(3),
                        TextInput::make('position')
                            ->label('Cargo')
                            ->nullable(),
                        FileUpload::make('photo_path')
                            ->label('Foto')
                            ->avatar()
                            ->disk('public')
                            ->directory('users/photos')
                            ->nullable()
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300'),

                    ])
                    ->columns(5)
                    ->columnSpan(2),

                Section::make('Información Sacramental / Fila')
                    ->schema([

                        Checkbox::make('baptism')
                            ->label('Bautismo')
                            ->default(false),
                        Checkbox::make('initiation')
                            ->label('Iniciación a la eucaristía')
                            ->default(false),
                        Checkbox::make('confirmation')
                            ->label('Confirmación')
                            ->default(false),

                        Select::make('row_position')
                            ->label('Ubicación en la fila')
                            ->options(RowPosition::class)
                            ->nullable(),

                    ]),

                Section::make('Demográficos y Contacto')
                    ->schema([
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->default(null),
                        TextInput::make('address')
                            ->label('Dirección')
                            ->nullable(),
                        Select::make('commune_id')
                            ->relationship('commune', 'name')
                            ->searchable()
                            ->label('Comuna')
                            ->nullable(),

                        Repeater::make('social_networks')
                            ->label('Redes sociales')
                            ->table([
                                TableColumn::make('Nombre')
                                    ->width('200px'),
                                TableColumn::make('URL'),
                            ])
                            ->schema([
                                Select::make('name')
                                    ->label('Red Social')
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'instagram' => 'Instagram',
                                        'twitter' => 'Twitter/X',
                                        'linkedin' => 'LinkedIn',
                                        'tiktok' => 'TikTok',
                                        'youtube' => 'YouTube',
                                        'whatsapp' => 'WhatsApp',
                                        'telegram' => 'Telegram',
                                    ])
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL / Usuario')
                                    ->required()
                                    ->placeholder('https://...')
                                    ->columnSpan(2),
                            ])
                            ->compact()
                            ->columnSpan(2),
                        Repeater::make('annotations')
                            ->label('Anotaciones')
                            ->columnSpan(2)
                            ->orderable(false)
                            ->table([
                                TableColumn::make('Fecha')
                                    ->width('200px'),
                                TableColumn::make('Detalle'),
                            ])
                            ->compact()
                            ->schema([
                                DatePicker::make('fecha')
                                    ->label('Fecha')
                                    ->default(now()),

                                TextInput::make('detalle')
                                    ->label('Detalle')
                                    ->required(),
                            ]),

                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Información de Membresía')
                    ->description(fn ($record) => $record && $record->inscriptionPayment
                                ? '✓ Pagado el '.$record->inscriptionPayment->date->format('d/m/Y').' - '.format_clp($record->inscriptionPayment->amount)
                                : null)

                    ->schema([
                        DatePicker::make('join_date')
                            ->label('Fecha de ingreso')
                            ->required(),
                        Select::make('user_type_id')
                            ->label('Tipo de usuario')
                            ->relationship('userType', 'name')
                            ->required()
                            ->preload(),
                        Select::make('membership_status')
                            ->label('Estado de membresía')
                            ->options(MembershipStatus::class)
                            ->default(MembershipStatus::Activo)
                            ->required(),

                        SignaturePad::make('signature')
                            ->label('Firma')
                            ->columnSpan(1),
                    ])
                    ->columns(1),

                Section::make('Seguridad y Acceso')
                    ->schema([
                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->required()
                            ->visibleOn('create'),
                        // Toggle::make('is_active')
                        //     ->label('Activo')
                        //     ->default(true)
                        //     ->required(),
                        Toggle::make('is_admin')
                            ->label('Administrador')
                            ->default(false),
                        Action::make('reset_password')
                            ->icon('heroicon-o-key')
                            ->label('Restablecer contraseña')
                            ->schema([
                                Select::make('opcion_password')
                                    ->label('Opción de contraseña')
                                    ->options([
                                        'run' => 'Clave Run sin digito verificador',
                                        'random' => 'Clave Aleatoria',
                                    ])
                                    ->required(),
                            ])
                            ->action(fn (array $data, User $record): Notification => Notification::make()
                                ->title('Clave: '.$record->resetPassword($data['opcion_password']))
                                ->success()
                                ->send()
                            )
                            ->color('warning'),

                    ])
                    ->columns(5)
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}
