<?php

namespace App\Filament\Clusters\Members\Resources\News\Pages;

use App\Filament\Clusters\Members\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;
}
