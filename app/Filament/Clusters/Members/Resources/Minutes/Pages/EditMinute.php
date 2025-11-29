<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Pages;

use App\Filament\Clusters\Members\Resources\Minutes\MinuteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMinute extends EditRecord
{
    protected static string $resource = MinuteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
