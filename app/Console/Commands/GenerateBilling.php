<?php

namespace App\Console\Commands;

use App\Models\Allocation;
use App\Models\AllocationLine;
use App\Models\BillingPeriod;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Services\BillingGenerator;
use Illuminate\Console\Command;

class GenerateBilling extends Command
{
    protected $signature = 'billing:generate {year} {month} {--dry-run} {--rebuild}';

    protected $description = 'Generate allocations and invoices for a billing period';

    public function __construct(private BillingGenerator $generator)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $year = (int) $this->argument('year');
        $month = (int) $this->argument('month');
        $dryRun = (bool) $this->option('dry-run');
        $rebuild = (bool) $this->option('rebuild');

        $this->info("Generating billing for {$year}-".str_pad((string) $month, 2, '0', STR_PAD_LEFT).($dryRun ? ' (dry-run)' : '').($rebuild ? ' (rebuild)' : ''));

        if ($rebuild && ! $dryRun) {
            $existing = BillingPeriod::query()->where('year', $year)->where('month', $month)->first();
            if ($existing) {
                $this->warn('Purging existing billing data for this period...');
                // Delete invoice lines then invoices
                InvoiceLine::query()->whereIn('invoice_id', function ($q) use ($existing) {
                    $q->select('id')->from('invoices')->where('billing_period_id', $existing->id);
                })->delete();
                Invoice::query()->where('billing_period_id', $existing->id)->delete();
                // Delete allocation lines then allocations
                AllocationLine::query()->whereIn('allocation_id', function ($q) use ($existing) {
                    $q->select('id')->from('allocations')->where('billing_period_id', $existing->id);
                })->delete();
                Allocation::query()->where('billing_period_id', $existing->id)->delete();
                $this->info('Purge complete.');
            }
        }

        $result = $this->generator->generate($year, $month, $dryRun);

        $invoices = $result['invoices'];
        $allocations = $result['allocations'];
        $period = $result['period'];

        $this->line("Period ID: {$period->id}");
        $this->line('Allocations: '.$allocations->count());
        $this->line('Invoices: '.$invoices->count());

        if ($dryRun) {
            $total = round($invoices->sum('total_to_pay'), 2);
            $this->line("Dry-run total to pay: {$total}");
        }

        $this->info('Done.');

        return self::SUCCESS;
    }
}
