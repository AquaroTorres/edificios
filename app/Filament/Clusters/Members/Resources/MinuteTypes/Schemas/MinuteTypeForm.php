<?php

namespace App\Filament\Clusters\Members\Resources\MinuteTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MinuteTypeForm
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
