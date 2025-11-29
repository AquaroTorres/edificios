<?php

namespace App\Filament\Clusters\Members\Resources\Attendances\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AttendanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->label('Fecha')
                    ->date(),
                TextEntry::make('subject')
                    ->label('Asunto'),
                TextEntry::make('creator.name')
                    ->label('Creado por'),
                TextEntry::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Actualizado en')
                    ->dateTime()
                    ->placeholder('-'),
                RepeatableEntry::make('attendees')
                    ->table([
                        TableColumn::make('Nombre'),
                        TableColumn::make('Run'),
                        TableColumn::make('Asistió'),
                    ])
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('run'),
                        IconEntry::make('pivot.attended')
                            ->boolean(),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}
