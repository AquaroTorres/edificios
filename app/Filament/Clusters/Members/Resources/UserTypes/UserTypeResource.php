<?php

namespace App\Filament\Clusters\Members\Resources\UserTypes;

use App\Filament\Clusters\Members\MembersCluster;
use App\Filament\Clusters\Members\Resources\UserTypes\Pages\CreateUserType;
use App\Filament\Clusters\Members\Resources\UserTypes\Pages\EditUserType;
use App\Filament\Clusters\Members\Resources\UserTypes\Pages\ListUserTypes;
use App\Filament\Clusters\Members\Resources\UserTypes\Pages\ViewUserType;
use App\Filament\Clusters\Members\Resources\UserTypes\Schemas\UserTypeForm;
use App\Filament\Clusters\Members\Resources\UserTypes\Schemas\UserTypeInfolist;
use App\Filament\Clusters\Members\Resources\UserTypes\Tables\UserTypesTable;
use App\Models\UserType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserTypeResource extends Resource
{
    protected static ?string $model = UserType::class;

    protected static ?string $modelLabel = 'tipo de usuario';

    protected static ?string $pluralModelLabel = 'tipos de usuarios';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $cluster = MembersCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Tipos de usuario';

    public static function form(Schema $schema): Schema
    {
        return UserTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserTypesTable::configure($table);
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
            'index' => ListUserTypes::route('/'),
            'create' => CreateUserType::route('/create'),
            // 'view' => ViewUserType::route('/{record}'),
            'edit' => EditUserType::route('/{record}/edit'),
        ];
    }
}
