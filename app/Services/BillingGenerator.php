<?php

namespace App\Services;

use App\Models\Allocation;
use App\Models\AllocationLine;
use App\Models\BillingPeriod;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BillingGenerator
{
    public function generate(int $year, int $month, bool $dryRun = false): array
    {
        return DB::transaction(function () use ($year, $month, $dryRun) {
            $period = BillingPeriod::query()->firstOrCreate(['year' => $year, 'month' => $month]);

            $expenses = Expense::query()
                ->where('billing_period_id', $period->id)
                ->with('type')
                ->get();

            if ($expenses->isEmpty()) {
                return ['period' => $period, 'invoices' => collect(), 'allocations' => collect()];
            }

            $reservePercent = (float) db_config('system.reserve_percent') ?? 0.0;
            $moraPercent = (float) db_config('system.mora_percent') ?? 0.0;

            // Normalize user proration so it sums to exactly 100%
            $rawProration = $this->computeUserProration();
            $sumRaw = max(1e-9, $rawProration->sum());
            $userPercents = $rawProration->map(fn ($v) => ($v / $sumRaw) * 100.0);

            $allocations = collect();
            $invoices = collect();
            $memoryLines = []; // user_id => array of allocation line data when dry-run

            // Pre-create allocations per user
            $allocationMap = [];
            foreach ($userPercents as $userId => $percentTotal) {
                if ($percentTotal <= 0) {
                    continue;
                }
                $user = User::find($userId);
                if (! $user) {
                    continue;
                }
                $allocation = new Allocation([
                    'billing_period_id' => $period->id,
                    'user_id' => $userId,
                    'percent_total' => round($percentTotal, 7),
                    'amount_total' => 0,
                ]);
                if (! $dryRun) {
                    $allocation->save();
                }
                $allocationMap[$userId] = $allocation;
                $allocations->push($allocation);
            }

            // Distribute each expense across users with remainder handling to preserve totals
            foreach ($expenses as $expense) {
                $amount = (float) $expense->amount;
                $sharesRaw = [];
                $sharesRounded = [];
                $fractionals = [];
                $sumRoundedDown = 0.0;

                foreach ($userPercents as $userId => $percent) {
                    $raw = $amount * ($percent / 100.0);
                    // floor to 2 decimals (not round) for initial remainder distribution baseline
                    $roundedDown = floor($raw * 100) / 100;
                    $sharesRaw[$userId] = $raw;
                    $sharesRounded[$userId] = $roundedDown;
                    $fractionals[$userId] = $raw - $roundedDown;
                    $sumRoundedDown += $roundedDown;
                }

                $leftover = round($amount - $sumRoundedDown, 2); // amount to distribute by pennies

                if ($leftover > 0) {
                    // Sort users by fractional remainder descending
                    arsort($fractionals);
                    while ($leftover > 0.000001) { // distribute 0.01 each pass
                        foreach ($fractionals as $userId => $fraction) {
                            if ($leftover <= 0) {
                                break 2;
                            }
                            $sharesRounded[$userId] += 0.01;
                            $leftover = round($leftover - 0.01, 2);
                        }
                    }
                }

                // Persist allocation lines & accumulate user totals
                foreach ($sharesRounded as $userId => $share) {
                    if ($share <= 0) {
                        continue;
                    }
                    /** @var Allocation $allocation */
                    $allocation = $allocationMap[$userId];
                    $allocation->amount_total += $share;
                    $line = new AllocationLine([
                        'allocation_id' => $allocation->id ?? null,
                        'expense_id' => $expense->id,
                        'expense_type_id' => $expense->expense_type_id,
                        'amount_user' => round($share, 2),
                    ]);
                    if (! $dryRun) {
                        $line->save();
                    } else {
                        $memoryLines[$userId] ??= [];
                        $memoryLines[$userId][] = [
                            'expense_type_id' => $expense->expense_type_id,
                            'expense_id' => $expense->id,
                            'amount_user' => round($share, 2),
                            'concept' => $expense->concept,
                            'description' => $expense->description ?? null,
                        ];
                    }
                }
            }

            // Finalize allocation totals
            foreach ($allocations as $allocation) {
                $allocation->amount_total = round($allocation->amount_total, 2);
                if (! $dryRun) {
                    $allocation->save();
                }
            }

            // Build invoices from allocation lines grouped by expense_type per user
            foreach ($allocations as $allocation) {
                if ($dryRun) {
                    $linesCollection = collect($memoryLines[$allocation->user_id] ?? []);
                    $lines = $linesCollection->groupBy('expense_type_id');
                    $subtotalCommon = round($linesCollection->sum('amount_user'), 2);
                } else {
                    $lines = AllocationLine::query()
                        ->where('allocation_id', $allocation->id)
                        ->get()
                        ->groupBy('expense_type_id');
                    $subtotalCommon = round($lines->flatten()->sum('amount_user'), 2);
                }
                $reserveAmount = round($subtotalCommon * ($reservePercent / 100.0), 2);
                $moraAmount = round($subtotalCommon * ($moraPercent / 100.0), 2);
                $totalToPay = round($subtotalCommon + $reserveAmount + $moraAmount, 2);

                $invoice = new Invoice([
                    'billing_period_id' => $period->id,
                    'user_id' => $allocation->user_id,
                    'number' => null,
                    'due_date' => null,
                    'status' => 'pending',
                    'subtotal_common' => $subtotalCommon,
                    'reserve_percent' => $reservePercent,
                    'reserve_amount' => $reserveAmount,
                    'mora_percent' => $moraPercent,
                    'mora_amount' => $moraAmount,
                    'total_to_pay' => $totalToPay,
                ]);
                if (! $dryRun) {
                    $invoice->save();
                }

                foreach ($lines as $expenseTypeId => $group) {
                    $amount = round(collect($group)->sum('amount_user'), 2);
                    $first = collect($group)->first();
                    $description = $first['description'] ?? $first['concept'] ?? 'Gasto común';
                    if (! $dryRun) {
                        /** @var AllocationLine $allocFirst */
                        $allocFirst = $group->first();
                        $invoiceLine = new InvoiceLine([
                            'invoice_id' => $invoice->id ?? null,
                            'expense_type_id' => (int) $expenseTypeId,
                            'expense_id' => $allocFirst->expense_id,
                            'description' => $allocFirst->expense->description ?? $allocFirst->expense->concept ?? 'Gasto común',
                            'amount' => $amount,
                        ]);
                        $invoiceLine->save();
                    } else {
                        // Attach a dynamic attribute for dry-run preview
                        $invoice->setAttribute('preview_line_'.$expenseTypeId, [
                            'expense_type_id' => (int) $expenseTypeId,
                            'description' => $description,
                            'amount' => $amount,
                        ]);
                    }
                }

                $invoices->push($invoice);
            }

            return ['period' => $period, 'invoices' => $invoices, 'allocations' => $allocations];
        });
    }

    protected function computeUserProration(): Collection
    {
        $byUser = Unit::query()
            ->whereNotNull('user_id')
            ->select('user_id', DB::raw('SUM(proration) as total_proration'))
            ->groupBy('user_id')
            ->pluck('total_proration', 'user_id');

        return collect($byUser)
            ->filter(fn ($v, $k) => $k !== null)
            ->map(fn ($v) => (float) $v);
    }
}
