<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                PdfViewerEntry::make('file')
                    ->hiddenLabel()
                    ->minHeight('80svh')
                    ->fileUrl(fn ($record) => route('admin.members.users.pdf', ['user' => $record])),
            ])
            ->columns(1);
    }
}
