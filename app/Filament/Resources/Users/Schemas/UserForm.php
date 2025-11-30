<?php

namespace App\Filament\Clusters\Members\Resources\Users\Schemas;

use App\Enums\MembershipStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                            ->required(),
                        TextInput::make('run')
                            ->label('RUN')
                            ->unique(ignoreRecord: true)
                            ->required(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->nullable(),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->nullable(),
                        DatePicker::make('join_date')
                            ->label('Fecha de Ingreso')
                            ->nullable(),
                        TextInput::make('position')
                            ->label('Cargo')
                            ->nullable(),
                        Select::make('membership_status')
                            ->label('Estado de Membresía')
                            ->options(MembershipStatus::class)
                            ->default(MembershipStatus::Activo)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
