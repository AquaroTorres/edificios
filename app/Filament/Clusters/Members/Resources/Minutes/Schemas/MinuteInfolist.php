<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class MinuteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                PdfViewerEntry::make('pdf')
                    ->disableLabel()
                    ->minHeight('80svh')
                    ->fileUrl(fn ($record): string => route('admin.members.minutes.pdf', $record))
                    ->columnSpanFull(),

                // RepeatableEntry::make('attendees')
                //     ->label('Asistentes')
                //     ->table([
                //         TableColumn::make('Nombre'),
                //         TableColumn::make('Run'),
                //         TableColumn::make('Asistió'),
                //     ])
                //     ->schema([
                //         TextEntry::make('name'),
                //         TextEntry::make('run'),
                //         IconEntry::make('pivot.attended')
                //             ->boolean(),
                //     ])
                //     ->columnSpanFull(),
            ])
            ->columns(4);
    }
}
