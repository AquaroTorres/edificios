<?php

namespace App\Filament\Clusters\Finance\Resources\Incomes;

use App\Filament\Clusters\Finance\FinanceCluster;
use App\Filament\Clusters\Finance\Resources\Incomes\Pages\CreateIncome;
use App\Filament\Clusters\Finance\Resources\Incomes\Pages\EditIncome;
use App\Filament\Clusters\Finance\Resources\Incomes\Pages\ListIncomes;
use App\Filament\Clusters\Finance\Resources\Incomes\Schemas\IncomeForm;
use App\Filament\Clusters\Finance\Resources\Incomes\Schemas\IncomeInfolist;
use App\Filament\Clusters\Finance\Resources\Incomes\Tables\IncomesTable;
use App\Models\Income;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $modelLabel = 'ingreso';

    protected static ?string $pluralModelLabel = 'ingresos';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingUp;

    protected static ?string $cluster = FinanceCluster::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Ingresos';

    public static function form(Schema $schema): Schema
    {
        return IncomeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IncomeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncomesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIncomes::route('/'),
            'create' => CreateIncome::route('/create'),
            'edit' => EditIncome::route('/{record}/edit'),
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
