<?php

namespace App\Filament\Clusters\Members\Resources\UserTypes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),
                TextEntry::make('fee')
                    ->label('Cuota')
                    ->money('USD'),
                TextEntry::make('users_count')
                    ->label('Total Usuarios')
                    ->state(function ($record) {
                        return $record->users()->count();
                    })
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Creado'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Actualizado'),
            ])
            ->columns(2);
    }
}
