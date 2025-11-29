<?php

namespace App\Filament\Clusters\Members\Resources\UserTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('ej. Miembro Regular, Miembro Premium')
                    ->helperText('Nombre único para este tipo de usuario'),
                TextInput::make('description')
                    ->label('Descripción')
                    ->nullable(),
                TextInput::make('fee')
                    ->label('Cuota')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$')
                    ->minValue(0)
                    ->helperText('Cuota anual asociada a este tipo de usuario (en pesos chilenos)'),
            ])
            ->columns(3);
    }
}
