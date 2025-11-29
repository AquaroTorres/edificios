<?php

namespace App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages;

use App\Filament\Clusters\Finance\Resources\IncomeTypes\IncomeTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIncomeType extends ViewRecord
{
    protected static string $resource = IncomeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
