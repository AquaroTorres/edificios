<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Pages;

use App\Filament\Clusters\Finance\Resources\MembershipFees\MembershipFeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMembershipFee extends CreateRecord
{
    protected static string $resource = MembershipFeeResource::class;
}
