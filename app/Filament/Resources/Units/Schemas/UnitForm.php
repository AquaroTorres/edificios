<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('correlative')
                    ->required(),
                Select::make('unit_type_id')
                    ->relationship('unitType', 'name')
                    ->required(),
                TextInput::make('number')
                    ->required()
                    ->numeric(),
                TextInput::make('floor')
                    ->required()
                    ->numeric(),
                TextInput::make('rol')
                    ->required(),
                TextInput::make('surface')
                    ->required()
                    ->numeric(),
                TextInput::make('proration')
                    ->required()
                    ->numeric(),
            ]);
    }
}
