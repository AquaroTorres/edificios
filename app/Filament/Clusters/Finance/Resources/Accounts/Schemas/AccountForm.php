<?php

namespace App\Filament\Clusters\Finance\Resources\Accounts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('description')
                    ->label('Descripción')
                    ->default(null),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->required(),
            ]);
    }
}
