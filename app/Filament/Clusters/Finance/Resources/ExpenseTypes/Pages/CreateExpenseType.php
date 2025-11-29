<?php

namespace App\Filament\Clusters\Finance\Resources\ExpenseTypes\Pages;

use App\Filament\Clusters\Finance\Resources\ExpenseTypes\ExpenseTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenseType extends CreateRecord
{
    protected static string $resource = ExpenseTypeResource::class;
}
