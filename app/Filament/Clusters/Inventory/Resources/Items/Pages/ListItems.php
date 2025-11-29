<?php

namespace App\Filament\Clusters\Inventory\Resources\Items\Pages;

use App\Filament\Clusters\Inventory\Resources\Items\ItemResource;
use App\Filament\Exports\ItemExporter;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()
                ->exporter(ItemExporter::class),
        ];
    }
}
