<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Pages;

use App\Filament\Clusters\Finance\Resources\MembershipFees\MembershipFeeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMembershipFee extends EditRecord
{
    protected static string $resource = MembershipFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
