<?php

namespace App\Filament\Clusters\Inventory\Resources\Items;

use App\Filament\Clusters\Inventory\InventoryCluster;
use App\Filament\Clusters\Inventory\Resources\Items\Pages\CreateItem;
use App\Filament\Clusters\Inventory\Resources\Items\Pages\EditItem;
use App\Filament\Clusters\Inventory\Resources\Items\Pages\ListItems;
use App\Filament\Clusters\Inventory\Resources\Items\Pages\ViewItem;
use App\Filament\Clusters\Inventory\Resources\Items\RelationManagers\AssignmentsRelationManager;
use App\Filament\Clusters\Inventory\Resources\Items\Schemas\ItemForm;
use App\Filament\Clusters\Inventory\Resources\Items\Schemas\ItemInfolist;
use App\Filament\Clusters\Inventory\Resources\Items\Tables\ItemsTable;
use App\Models\Item;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $modelLabel = 'artículo';

    protected static ?string $pluralModelLabel = 'artículos';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = InventoryCluster::class;

    protected static ?int $navigationSort = -2;

    protected static ?string $recordTitleAttribute = 'code';

    protected static ?string $navigationLabel = 'Artículos';

    public static function form(Schema $schema): Schema
    {
        return ItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AssignmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItems::route('/'),
            'create' => CreateItem::route('/create'),
            'view' => ViewItem::route('/{record}'),
            'edit' => EditItem::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
