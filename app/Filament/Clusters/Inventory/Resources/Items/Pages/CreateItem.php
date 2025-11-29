<?php

namespace App\Filament\Clusters\Inventory\Resources\Items\Pages;

use App\Filament\Clusters\Inventory\Resources\Items\ItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;
}
