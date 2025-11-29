<?php

namespace App\Filament\Clusters\Members\Resources\UserTypes\Pages;

use App\Filament\Clusters\Members\Resources\UserTypes\UserTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserType extends ViewRecord
{
    protected static string $resource = UserTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
