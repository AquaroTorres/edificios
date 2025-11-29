<?php

namespace App\Filament\Clusters\Members\Resources\News;

use App\Filament\Clusters\Members\MembersCluster;
use App\Filament\Clusters\Members\Resources\News\Pages\CreateNews;
use App\Filament\Clusters\Members\Resources\News\Pages\EditNews;
use App\Filament\Clusters\Members\Resources\News\Pages\ListNews;
use App\Filament\Clusters\Members\Resources\News\Schemas\NewsForm;
use App\Filament\Clusters\Members\Resources\News\Schemas\NewsInfolist;
use App\Filament\Clusters\Members\Resources\News\Tables\NewsTable;
use App\Models\News;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Newspaper;

    protected static ?string $cluster = MembersCluster::class;

    protected static ?string $navigationLabel = 'Noticias';

    protected static ?string $modelLabel = 'noticia';

    protected static ?string $pluralModelLabel = 'noticias';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return NewsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NewsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsTable::configure($table);
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
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}
