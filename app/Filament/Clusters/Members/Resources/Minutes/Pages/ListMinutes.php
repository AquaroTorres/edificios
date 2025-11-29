<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Pages;

use App\Filament\Clusters\Members\Resources\Minutes\MinuteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinutes extends ListRecords
{
    protected static string $resource = MinuteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
