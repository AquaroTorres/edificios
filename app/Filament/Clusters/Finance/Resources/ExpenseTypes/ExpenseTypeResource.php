<?php

namespace App\Filament\Clusters\Finance\Resources\ExpenseTypes;

use App\Filament\Clusters\Finance\FinanceCluster;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Pages\CreateExpenseType;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Pages\EditExpenseType;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Pages\ListExpenseTypes;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Pages\ViewExpenseType;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Schemas\ExpenseTypeForm;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Schemas\ExpenseTypeInfolist;
use App\Filament\Clusters\Finance\Resources\ExpenseTypes\Tables\ExpenseTypesTable;
use App\Models\ExpenseType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExpenseTypeResource extends Resource
{
    protected static ?string $model = ExpenseType::class;

    protected static ?string $modelLabel = 'tipo de gasto';

    protected static ?string $pluralModelLabel = 'tipos de gastos';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static ?string $cluster = FinanceCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Tipos de Gasto';

    public static function form(Schema $schema): Schema
    {
        return ExpenseTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExpenseTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpenseTypesTable::configure($table);
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
            'index' => ListExpenseTypes::route('/'),
            'create' => CreateExpenseType::route('/create'),
            // 'view' => ViewExpenseType::route('/{record}'),
            'edit' => EditExpenseType::route('/{record}/edit'),
        ];
    }
}
