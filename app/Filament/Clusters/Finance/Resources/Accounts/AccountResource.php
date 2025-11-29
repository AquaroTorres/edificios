<?php

namespace App\Filament\Clusters\Finance\Resources\Accounts;

use App\Filament\Clusters\Finance\FinanceCluster;
use App\Filament\Clusters\Finance\Resources\Accounts\Pages\CreateAccount;
use App\Filament\Clusters\Finance\Resources\Accounts\Pages\EditAccount;
use App\Filament\Clusters\Finance\Resources\Accounts\Pages\ListAccounts;
use App\Filament\Clusters\Finance\Resources\Accounts\Schemas\AccountForm;
use App\Filament\Clusters\Finance\Resources\Accounts\Tables\AccountsTable;
use App\Models\Account;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $modelLabel = 'cuenta';

    protected static ?string $pluralModelLabel = 'cuentas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Banknotes;

    protected static ?string $cluster = FinanceCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Cuentas';

    public static function form(Schema $schema): Schema
    {
        return AccountForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountsTable::configure($table);
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
            'index' => ListAccounts::route('/'),
            'create' => CreateAccount::route('/create'),
            'edit' => EditAccount::route('/{record}/edit'),
        ];
    }
}
