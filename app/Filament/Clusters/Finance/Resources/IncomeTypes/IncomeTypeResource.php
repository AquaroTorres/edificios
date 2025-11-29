<?php

namespace App\Filament\Clusters\Finance\Resources\IncomeTypes;

use App\Filament\Clusters\Finance\FinanceCluster;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages\CreateIncomeType;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages\EditIncomeType;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages\ListIncomeTypes;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Pages\ViewIncomeType;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Schemas\IncomeTypeForm;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Schemas\IncomeTypeInfolist;
use App\Filament\Clusters\Finance\Resources\IncomeTypes\Tables\IncomeTypesTable;
use App\Models\IncomeType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IncomeTypeResource extends Resource
{
    protected static ?string $model = IncomeType::class;

    protected static ?string $modelLabel = 'tipo de ingreso';

    protected static ?string $pluralModelLabel = 'tipos de ingresos';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static ?string $cluster = FinanceCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Tipos de Ingreso';

    public static function form(Schema $schema): Schema
    {
        return IncomeTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IncomeTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncomeTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canEdit($record): bool
    {
        // No se puede editar el tipo de ingreso de cuotas de membresía
        return $record->id !== 1;
    }

    public static function canDelete($record): bool
    {
        // No se puede eliminar el tipo de ingreso de cuotas de membresía
        return $record->id !== 1;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIncomeTypes::route('/'),
            'create' => CreateIncomeType::route('/create'),
            // 'view' => ViewIncomeType::route('/{record}'),
            'edit' => EditIncomeType::route('/{record}/edit'),
        ];
    }
}
