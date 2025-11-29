<?php

namespace App\Filament\Clusters\Inventory\Resources\Locations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('ej. Almacén principal, Sala de almacenamiento A'),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Breve descripción de esta ubicación'),

                Textarea::make('address')
                    ->label('Dirección')
                    ->rows(2)
                    ->maxLength(500)
                    ->placeholder('Dirección física de esta ubicación'),

                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->helperText('Solo las ubicaciones activas estarán disponibles para asignación de artículos'),
            ])
            ->columns(1);
    }
}
