<?php

namespace App\Console\Commands;

use App\Filament\Clusters\Finance\Resources\MembershipFees\Actions\GenerateAnnualFeesAction;
use Illuminate\Console\Command;

class GenerateAnnualMembershipFees extends Command
{
    protected $signature = 'fees:generate {year?}';

    protected $description = 'Generate annual membership fees (April & June installments)';

    public function handle(): int
    {
        $data = ['year' => now()->year];
        GenerateAnnualFeesAction::handle($data);

        echo "✓ Created  membership fees for year {$data['year']}\n";

        return 0;
    }
}
