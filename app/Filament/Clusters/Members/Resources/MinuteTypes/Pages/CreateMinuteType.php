<?php

namespace App\Filament\Clusters\Members\Resources\MinuteTypes\Pages;

use App\Filament\Clusters\Members\Resources\MinuteTypes\MinuteTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMinuteType extends CreateRecord
{
    protected static string $resource = MinuteTypeResource::class;
}
