<?php

namespace App\Filament\Resources\UnitTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
