<?php

namespace App\Filament\Clusters\Members\Resources\Minutes;

use App\Filament\Clusters\Members\MembersCluster;
use App\Filament\Clusters\Members\Resources\Minutes\Pages\CreateMinute;
use App\Filament\Clusters\Members\Resources\Minutes\Pages\EditMinute;
use App\Filament\Clusters\Members\Resources\Minutes\Pages\ListMinutes;
use App\Filament\Clusters\Members\Resources\Minutes\Pages\ViewMinute;
use App\Filament\Clusters\Members\Resources\Minutes\Schemas\MinuteForm;
use App\Filament\Clusters\Members\Resources\Minutes\Schemas\MinuteInfolist;
use App\Filament\Clusters\Members\Resources\Minutes\Tables\MinutesTable;
use App\Models\Minute;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MinuteResource extends Resource
{
    protected static ?string $model = Minute::class;

    protected static ?string $modelLabel = 'acta';

    protected static ?string $pluralModelLabel = 'actas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $cluster = MembersCluster::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Actas';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return MinuteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MinuteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MinutesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AttendeesRelationManager::class,
        ];

    }

    public static function getPages(): array
    {
        return [
            'index' => ListMinutes::route('/'),
            'create' => CreateMinute::route('/create'),
            // 'view' => ViewMinute::route('/{record}'),
            'edit' => EditMinute::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (! auth()->user()->is_admin && ! auth()->user()->is_super_admin) {
            $query->where('is_public', true);
        }

        return $query;
    }
}
