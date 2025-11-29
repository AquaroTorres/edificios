<?php

namespace App\Filament\Clusters\Inventory\Resources\Categories\Pages;

use App\Filament\Clusters\Inventory\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
