<?php

namespace App\Filament\Clusters\Finance\Resources\IncomeTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IncomeTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('ej. Cuotas de membresía, Donaciones'),
                Select::make('account_id')
                    ->label('Cuenta Asociada')
                    ->relationship('account', 'name')
                    ->required(),
                // TextInput::make('buget')
                //     ->label('Presupuesto')
                //     ->numeric()
                //     ->minValue(0)
                //     ->placeholder('Presupuesto asignado para este tipo de ingreso'),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->inline(false)
                    ->helperText('Disponible para selección'),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Breve descripción de este tipo de ingreso')
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}
