<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PaidMembershipFeesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $membershipFees = auth()->user()->membershipFees()
            ->orderBy('due_at', 'asc')
            ->limit(4)
            ->get();

        return $membershipFees->map(fn ($membershipFee) => Stat::make(
            label: $membershipFee->concept.($membershipFee->period ? " {$membershipFee->period}" : '').' - '.format_clp($membershipFee->amount).' ('.$membershipFee->due_at->format('d/m/Y').')',
            value: format_clp($membershipFee->paid_amount)
        )->description('Pendiente: '.format_clp($membershipFee->pending_amount).' ('.$membershipFee->status->value.')')
            ->color(match ($membershipFee->status->value) {
                'pagado' => 'success',
                'parcial' => 'warning',
                'pendiente' => 'info',
                'vencido' => 'danger',
                default => 'gray'
            }))->toArray();
    }
}
