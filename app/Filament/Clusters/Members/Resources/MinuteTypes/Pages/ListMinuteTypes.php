<?php

namespace App\Filament\Clusters\Members\Resources\MinuteTypes\Pages;

use App\Filament\Clusters\Members\Resources\MinuteTypes\MinuteTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinuteTypes extends ListRecords
{
    protected static string $resource = MinuteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
