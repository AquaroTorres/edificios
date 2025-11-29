<?php

namespace App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages;

use App\Filament\Clusters\Finance\Resources\IncomeTypes\IncomeTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIncomeType extends EditRecord
{
    protected static string $resource = IncomeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
