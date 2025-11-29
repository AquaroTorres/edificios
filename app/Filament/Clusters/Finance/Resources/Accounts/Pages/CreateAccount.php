<?php

namespace App\Filament\Clusters\Finance\Resources\Accounts\Pages;

use App\Filament\Clusters\Finance\Resources\Accounts\AccountResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAccount extends CreateRecord
{
    protected static string $resource = AccountResource::class;
}
