<?php

namespace App\Filament\Clusters\Finance\Resources\Expenses\Pages;

use App\Filament\Clusters\Finance\Resources\Expenses\ExpenseResource;
use App\Filament\Exports\ExpenseExporter;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListExpenses extends ListRecords
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()
                ->exporter(ExpenseExporter::class),
        ];
    }
}
