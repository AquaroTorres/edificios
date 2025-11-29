<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Pages;

use App\Filament\Clusters\Finance\Resources\MembershipFees\Actions\GenerateAnnualFeesAction;
use App\Filament\Clusters\Finance\Resources\MembershipFees\Actions\GenerateSpecialFeeAction;
use App\Filament\Clusters\Finance\Resources\MembershipFees\MembershipFeeResource;
use Filament\Resources\Pages\ListRecords;

class ListMembershipFees extends ListRecords
{
    protected static string $resource = MembershipFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            GenerateAnnualFeesAction::make('generateAnnualFees'),
            GenerateSpecialFeeAction::make('createBulkMembershipFee'),
        ];
    }
}
