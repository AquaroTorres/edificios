<?php

namespace App\Filament\Admin\Pages;

use App\Notifications\TestNotification;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Inerba\DbConfig\AbstractPageSettings;

class SystemSettings extends AbstractPageSettings
{
    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    protected static ?string $title = 'Sistema';

    // protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver'; // Uncomment if you want to set a custom navigation icon

    // protected ?string $subheading = ''; // Uncomment if you want to set a custom subheading

    // protected static ?string $slug = 'system-settings'; // Uncomment if you want to set a custom slug

    protected string $view = 'filament.pages.system-settings';

    protected function settingName(): string
    {
        return 'system';
    }

    public static function canAccess(): bool
    {
        return auth()->user()->is_admin == true;
    }

    /**
     * Provide default values.
     *
     * @return array<string, mixed>
     */
    public function getDefaultData(): array
    {
        return [];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->label('Información de la compañia')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Nombre de compañia'),
                        TextInput::make('company_rut')
                            ->label('RUT de compañia'),
                        TextInput::make('company_address')
                            ->label('Dirección de compañia'),
                        TextInput::make('company_phone')
                            ->label('Teléfono de compañia'),
                        TextInput::make('company_email')
                            ->label('Email de compañia'),
                        FileUpload::make('company_logo')
                            ->label('Logo de compañia')
                            ->disk('public')
                            ->visibility('public')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageResizeTargetHeight(200),
                        // ->imageCropAspectRatio('1:1')
                        TextInput::make('saint_name')
                            ->label('Nombre del Santo o Virgen'),
                        TextInput::make('saint_town')
                            ->label('Pueblo donde se realiza la festividad'),
                        TextInput::make('company_years')
                            ->label('Años de antiguedad del club'),
                        TextInput::make('saint_month')
                            ->label('Mes en que se desarrolla la festividad'),
                    ]),
                Section::make()
                    ->label('Configuración de membresía')
                    ->schema([
                        TextInput::make('months_with_fees')
                            ->helperText('Meses en los cuales el sistema generará una cuota. Ej:4,6 para abril y junio.')
                            ->label('Meses con cuotas'),
                    ]),
                Section::make()
                    ->label('Redes Sociales y Enlaces')
                    ->schema([
                        TextInput::make('company_slogan')
                            ->label('Eslogan de la compañia'),
                        TextInput::make('facebook_link')
                            ->label('Facebook Link'),
                        TextInput::make('instagram_link')
                            ->label('Instagram Link'),
                        KeyValue::make('links')
                            ->label('Enlaces de interés')
                            ->helperText('Estos enlaces se mostrarán en el menú "Enlaces" de la aplicación.')
                            ->keyLabel('Nombre')
                            ->valueLabel('URL')
                            ->addButtonLabel('Agregar enlace'),
                    ]),
                Section::make()
                    ->label('Configuración interna')
                    ->collapsed()
                    ->schema([
                        TextInput::make('preapproval_plan_id')->label('Mercado Pago Preapproval Plan ID'),
                        Toggle::make('subscription')->label('Subscription'),
                        DateTimePicker::make('subscription_at')->label('Mercado Pago Subscription At'),
                        Toggle::make('maintenance_mode')->label('Maintenance Mode'),

                        Action::make('send_test_email')
                            ->label('Send Test Email')
                            ->action(fn () => auth()->user()->notify(new TestNotification)),
                    ])
                    ->visible(auth()->user()->is_super_admin),
            ])
            ->columns(4)
            ->statePath('data');
    }
}
