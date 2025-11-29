<?php

namespace App\Filament\Clusters\Members\Resources\MinuteTypes;

use App\Filament\Clusters\Members\MembersCluster;
use App\Filament\Clusters\Members\Resources\MinuteTypes\Pages\CreateMinuteType;
use App\Filament\Clusters\Members\Resources\MinuteTypes\Pages\EditMinuteType;
use App\Filament\Clusters\Members\Resources\MinuteTypes\Pages\ListMinuteTypes;
use App\Filament\Clusters\Members\Resources\MinuteTypes\Schemas\MinuteTypeForm;
use App\Filament\Clusters\Members\Resources\MinuteTypes\Tables\MinuteTypesTable;
use App\Models\MinuteType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MinuteTypeResource extends Resource
{
    protected static ?string $model = MinuteType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static ?string $cluster = MembersCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Tipos de actas';

    protected static ?string $modelLabel = 'tipo de acta';

    protected static ?string $pluralModelLabel = 'tipos de actas';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return MinuteTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MinuteTypesTable::configure($table);
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
            'index' => ListMinuteTypes::route('/'),
            'create' => CreateMinuteType::route('/create'),
            'edit' => EditMinuteType::route('/{record}/edit'),
        ];
    }
}
