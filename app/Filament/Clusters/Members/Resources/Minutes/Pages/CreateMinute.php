<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Pages;

use App\Filament\Clusters\Members\Resources\Minutes\MinuteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMinute extends CreateRecord
{
    protected static string $resource = MinuteResource::class;
}
