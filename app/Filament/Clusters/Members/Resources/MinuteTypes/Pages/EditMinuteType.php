<?php

namespace App\Filament\Clusters\Members\Resources\MinuteTypes\Pages;

use App\Filament\Clusters\Members\Resources\MinuteTypes\MinuteTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMinuteType extends EditRecord
{
    protected static string $resource = MinuteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
