<?php

namespace App\Filament\Clusters\Finance\Resources\Incomes\Pages;

use App\Filament\Clusters\Finance\Resources\Incomes\IncomeResource;
use App\Filament\Clusters\Finance\Resources\Incomes\Widgets;
use App\Filament\Exports\IncomeExporter;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()
                ->exporter(IncomeExporter::class),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // Widgets\FinanceIncomeByTypeWidget::class,
            // Add more widgets here if needed
        ];
    }
}
