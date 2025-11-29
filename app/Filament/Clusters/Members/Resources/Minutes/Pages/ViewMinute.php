<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Pages;

use App\Filament\Clusters\Members\Resources\Minutes\MinuteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMinute extends ViewRecord
{
    protected static string $resource = MinuteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
