<?php

namespace App\Filament\Clusters\Inventory\Resources\Locations;

use App\Filament\Clusters\Inventory\InventoryCluster;
use App\Filament\Clusters\Inventory\Resources\Locations\Pages\CreateLocation;
use App\Filament\Clusters\Inventory\Resources\Locations\Pages\EditLocation;
use App\Filament\Clusters\Inventory\Resources\Locations\Pages\ListLocations;
use App\Filament\Clusters\Inventory\Resources\Locations\Pages\ViewLocation;
use App\Filament\Clusters\Inventory\Resources\Locations\Schemas\LocationForm;
use App\Filament\Clusters\Inventory\Resources\Locations\Schemas\LocationInfolist;
use App\Filament\Clusters\Inventory\Resources\Locations\Tables\LocationsTable;
use App\Models\Location;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $modelLabel = 'ubicación';

    protected static ?string $pluralModelLabel = 'ubicaciones';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $cluster = InventoryCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Ubicaciones';

    public static function form(Schema $schema): Schema
    {
        return LocationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LocationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLocations::route('/'),
            'create' => CreateLocation::route('/create'),
            'view' => ViewLocation::route('/{record}'),
            'edit' => EditLocation::route('/{record}/edit'),
        ];
    }
}
