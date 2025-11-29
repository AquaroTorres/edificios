<?php

namespace App\Filament\Clusters\Finance\Resources\Incomes\Schemas;

use Filament\Schemas\Schema;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class IncomeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                PdfViewerEntry::make('file')
                    ->hiddenLabel()
                    ->minHeight('80svh')
                    ->fileUrl(fn ($record) => route('admin.finance.incomes.pdf', ['income' => $record])),
            ])
            ->columns(1);
    }
}
