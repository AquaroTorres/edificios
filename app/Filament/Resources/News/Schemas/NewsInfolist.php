<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NewsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Título'),
                TextEntry::make('body')
                    ->label('Contenido')
                    ->html(),
                TextEntry::make('link')
                    ->label('Enlace')
                    ->url(fn ($record) => $record->link),
                ImageEntry::make('photo_path')
                    ->label('Foto'),
            ])
            ->columns(1);
    }
}
