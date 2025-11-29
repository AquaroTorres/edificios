<?php

namespace App\Filament\Clusters\Inventory\Resources\Locations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LocationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->label('Dirección')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                TextEntry::make('items_count')
                    ->label('Total de Items')
                    ->state(function ($record) {
                        return $record->items()->count();
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Creado'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Última Actualización'),
            ])
            ->columns(2);
    }
}
