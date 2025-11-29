<?php

namespace App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages;

use App\Filament\Clusters\Finance\Resources\IncomeTypes\IncomeTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIncomeType extends CreateRecord
{
    protected static string $resource = IncomeTypeResource::class;
}
