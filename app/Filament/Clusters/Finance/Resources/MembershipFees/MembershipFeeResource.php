<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees;

use App\Filament\Clusters\Finance\FinanceCluster;
use App\Filament\Clusters\Finance\Resources\MembershipFees\Pages\CreateMembershipFee;
use App\Filament\Clusters\Finance\Resources\MembershipFees\Pages\EditMembershipFee;
use App\Filament\Clusters\Finance\Resources\MembershipFees\Pages\ListMembershipFees;
use App\Filament\Clusters\Finance\Resources\MembershipFees\Schemas\MembershipFeeForm;
use App\Filament\Clusters\Finance\Resources\MembershipFees\Tables\MembershipFeesTable;
use App\Models\MembershipFee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MembershipFeeResource extends Resource
{
    protected static ?string $model = MembershipFee::class;

    protected static ?string $modelLabel = 'cuota de membresía';

    protected static ?string $pluralModelLabel = 'cuotas de membresías';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Banknotes;

    protected static ?string $cluster = FinanceCluster::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Membresías';

    public static function form(Schema $schema): Schema
    {
        return MembershipFeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MembershipFeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMembershipFees::route('/'),
            'create' => CreateMembershipFee::route('/create'),
            'edit' => EditMembershipFee::route('/{record}/edit'),
        ];
    }
}
