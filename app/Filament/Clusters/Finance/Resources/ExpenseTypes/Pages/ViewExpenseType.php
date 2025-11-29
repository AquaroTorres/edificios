<?php

namespace App\Filament\Clusters\Finance\Resources\ExpenseTypes\Pages;

use App\Filament\Clusters\Finance\Resources\ExpenseTypes\ExpenseTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewExpenseType extends ViewRecord
{
    protected static string $resource = ExpenseTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
