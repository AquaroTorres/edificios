<?php

namespace App\Filament\Clusters\Members\Resources\UserTypes\Pages;

use App\Filament\Clusters\Members\Resources\UserTypes\UserTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserType extends CreateRecord
{
    protected static string $resource = UserTypeResource::class;
}
