<?php

namespace App\Filament\Auth;

use App\Enums\Gender;
use App\Filament\Clusters\Finance\Resources\Incomes\Schemas\IncomeInfolist;
use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // $this->getNameFormComponent(),
                // TextInput::make('run')
                //     ->label('RUN')
                //     ->unique(ignoreRecord: true)
                //     ->nullable()
                //     ->maxLength(12)
                //     ->placeholder('12345678-9')
                //     ->disabled(),
                // DatePicker::make('birth_date')
                //     ->label('Fecha de nacimiento')
                //     ->nullable(),
                // Select::make('gender')
                //     ->label('Sexo')
                //     ->options(Gender::class)
                //     ->nullable(),
                // $this->getEmailFormComponent(),
                // $this->getPasswordFormComponent(),
                // $this->getPasswordConfirmationFormComponent(),

                TextEntry::make('Información:')
                    ->size(TextSize::Large)
                    ->color('warning')
                    ->default('IMPORTANTE: Por favor cambie su contraseña para poder acceder al sistema.')
                    ->visible(auth()->user() && ! auth()->user()->password_changed_at)
                    ->columnSpanFull(),

                Section::make('Información Personal')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->inlineLabel(false)
                            ->columnSpan(2)
                            ->disabled()
                            ->required(),
                        TextInput::make('run')
                            ->label('RUN')
                            ->inlineLabel(false)
                            ->unique(ignoreRecord: true)
                            ->nullable()
                            ->disabled()
                            ->placeholder('12345678-9'),
                        DatePicker::make('birth_date')
                            ->label('Fecha de nacimiento')
                            ->inlineLabel(false)
                            ->disabled()
                            ->nullable(),
                        Select::make('gender')
                            ->label('Sexo')
                            ->inlineLabel(false)
                            ->options(Gender::class)
                            ->disabled()
                            ->nullable(),
                        Textarea::make('health_background')
                            ->label('Antecedentes de salud')
                            ->inlineLabel(false)
                            ->nullable()
                            ->disabled()
                            ->rows(3)
                            ->columnSpan(3),
                        // FileUpload::make('photo_path')
                        //     ->label('Foto')
                        //     ->avatar()
                        //     ->disk('public')
                        //     ->directory('users/photos')
                        //     ->nullable()
                        //     ->imageCropAspectRatio('1:1')
                        //     ->imageResizeTargetWidth('300')
                        //     ->imageResizeTargetHeight('300'),

                    ])
                    ->columns(5)
                    ->columnSpan(2),

                Section::make('Información Sacramental')
                    ->schema([
                        TextEntry::make('baptism')
                            ->label('Bautismo')
                            ->icon(fn ($state) => $state == true ? Heroicon::CheckCircle : Heroicon::XCircle)
                            ->iconColor(fn ($state) => $state == true ? 'success' : null)
                            ->formatStateUsing(fn () => ''),
                        TextEntry::make('initiation')
                            ->label('Iniciación a la eucaristía')
                            ->icon(fn ($state) => $state == true ? Heroicon::CheckCircle : Heroicon::XCircle)
                            ->iconColor(fn ($state) => $state == true ? 'success' : null)
                            ->formatStateUsing(fn () => ''),
                        TextEntry::make('confirmation')
                            ->label('Confirmación')
                            ->icon(fn ($state) => $state == true ? Heroicon::CheckCircle : Heroicon::XCircle)
                            ->iconColor(fn ($state) => $state == true ? 'success' : null)
                            ->formatStateUsing(fn () => ''),
                    ]),

                Section::make('Demográficos y Contacto')
                    ->schema([
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->inlineLabel(false)
                            ->email()
                            ->disabled(),
                        TextInput::make('phone')
                            ->inlineLabel(false)
                            ->label('Teléfono')
                            ->tel()
                            ->default(null)
                            ->disabled(),
                        TextInput::make('address')
                            ->inlineLabel(false)
                            ->label('Dirección')
                            ->nullable()
                            ->disabled(),
                        Select::make('commune_id')
                            ->inlineLabel(false)
                            ->relationship('commune', 'name')
                            ->searchable()
                            ->label('Comuna')
                            ->nullable()
                            ->disabled(),
                        // Repeater::make('social_networks')
                        //     ->label('Redes sociales')
                        //     ->table([
                        //         TableColumn::make('Nombre')
                        //             ->width('200px'),
                        //         TableColumn::make('URL'),
                        //     ])
                        //     ->schema([
                        //         Select::make('name')
                        //             ->label('Red Social')
                        //             ->options([
                        //                 'facebook' => 'Facebook',
                        //                 'instagram' => 'Instagram',
                        //                 'twitter' => 'Twitter/X',
                        //                 'linkedin' => 'LinkedIn',
                        //                 'tiktok' => 'TikTok',
                        //                 'youtube' => 'YouTube',
                        //                 'whatsapp' => 'WhatsApp',
                        //                 'telegram' => 'Telegram',
                        //             ]),
                        //         TextInput::make('url')
                        //             ->label('URL / Usuario')

                        //             ->placeholder('https://...')
                        //             ->columnSpan(2),
                        //     ])
                        //     ->compact()
                        //     ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Seguridad y Acceso')
                    ->schema([
                        $this->getPasswordFormComponent()
                            ->inlineLabel(false),
                        $this->getPasswordConfirmationFormComponent()
                            ->inlineLabel(false),

                    ])
                    ->columnSpan(1),

                Section::make('Información de Cuotas')
                    ->schema([
                        RepeatableEntry::make('membershipFees')
                            ->label('Cuotas de Membresía')
                            ->inlineLabel(false)
                            ->schema([
                                TextEntry::make('concept')
                                    ->label('Concepto'),
                                TextEntry::make('due_at')
                                    ->label('Vencimiento')
                                    ->date('d/m/Y'),
                                TextEntry::make('amount')
                                    ->label('Monto')
                                    ->formatStateUsing(fn ($state) => format_clp($state)),
                                TextEntry::make('pending_amount')
                                    ->label('Monto Pendiente')
                                    ->formatStateUsing(fn ($state) => format_clp($state)),
                                TextEntry::make('year')
                                    ->label('Año'),
                                TextEntry::make('status')
                                    ->label('Estado'),
                                RepeatableEntry::make('payments')
                                    ->label('Pagos realizados')
                                    ->table([
                                        TableColumn::make('Fecha de pago')
                                            ->width('130px'),
                                        TableColumn::make('Método de pago')
                                            ->width('130px'),
                                        TableColumn::make('Monto'),
                                        TableColumn::make('Comprobante')
                                            ->width('200px'),

                                    ])
                                    ->schema([
                                        TextEntry::make('date')
                                            ->date('d/m/Y'),
                                        TextEntry::make('mechanism'),
                                        TextEntry::make('amount')
                                            ->formatStateUsing(fn ($state) => format_clp($state)),
                                        TextEntry::make('created_at')
                                            ->icon(Heroicon::DocumentText)
                                            ->action(
                                                Action::make('view')
                                                    ->infolist(function (Schema $schema) {
                                                        return IncomeInfolist::configure($schema);
                                                    })
                                                    ->modalSubmitAction(false)
                                                    ->modalCancelActionLabel('Cerrar')
                                                    ->modalHeading('Comprobante de pago')
                                            ),

                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columns(6)
                            ->columnSpan(2),
                    ])
                    ->columnSpan(2),

                Section::make('Información de Membresía')
                    ->schema([
                        TextEntry::make('join_date')
                            ->label('Fecha de ingreso')
                            ->date('d/m/Y'),
                        TextEntry::make('userType.name')
                            ->label('Tipo de usuario'),
                        TextEntry::make('membership_status')
                            ->label('Estado de membresía'),
                        TextEntry::make('position')
                            ->label('Cargo'),
                        TextEntry::make('row_position')
                            ->label('Ubicación en la fila'),
                        Placeholder::make('inscription_status')
                            ->label('Estado de Inscripción')
                            ->content(fn ($record) => $record->inscriptionPayment
                                ? '✓ Pagado el '.$record->inscriptionPayment->date->format('d/m/Y').' - '.format_clp($record->inscriptionPayment->amount)
                                : 'Sin pago de inscripción')
                            ->color(fn ($record) => $record->hasInscriptionPaid() ? Color::Green : Color::Orange)
                            ->visibleOn('edit'),
                    ])
                    ->columns(1),

            ])
            ->columns(3);
    }

    // protected function getEmailFormComponent(): Component
    // {
    //     return TextInput::make('email')
    //         ->label(__('filament-panels::auth/pages/edit-profile.form.email.label'))
    //         ->email()
    //         ->required()
    //         ->maxLength(255)
    //         ->live(debounce: 500);
    // }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.pages.dashboard');
    }
}
