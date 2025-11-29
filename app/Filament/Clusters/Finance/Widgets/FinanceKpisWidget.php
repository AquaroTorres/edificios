<?php

namespace App\Filament\Clusters\Finance\Widgets;

use App\Enums\MembershipFeeStatus;
use App\Models\Expense;
use App\Models\Income;
use App\Models\MembershipFee;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinanceKpisWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $from = now()->startOfMonth();
        $to = now()->endOfMonth();

        $ingresosMes = (int) Income::whereBetween('date', [$from, $to])->sum('amount');
        $gastosMes = (int) Expense::whereBetween('date', [$from, $to])->sum('amount');
        $balanceMes = $ingresosMes - $gastosMes;

        $pendienteTotal = (int) MembershipFee::query()
            ->whereIn('status', [MembershipFeeStatus::Pendiente, MembershipFeeStatus::Parcial, MembershipFeeStatus::Vencido])
            ->selectRaw('COALESCE(SUM(amount - paid_amount), 0) as total')
            ->value('total');

        $vencidas = (int) MembershipFee::where('status', MembershipFeeStatus::Vencido)->count();

        $porVencer30 = (int) MembershipFee::query()
            ->whereIn('status', [MembershipFeeStatus::Pendiente, MembershipFeeStatus::Parcial])
            ->whereBetween('due_at', [now(), now()->addDays(30)])
            ->count();

        return [
            Stat::make('Ingresos (mes)', format_clp($ingresosMes))
                ->description($from->format('d/m').' - '.$to->format('d/m'))
                ->color('success'),
            Stat::make('Gastos (mes)', format_clp($gastosMes))
                ->description($from->format('d/m').' - '.$to->format('d/m'))
                ->color('danger'),
            Stat::make('Balance (mes)', format_clp($balanceMes))
                ->description($balanceMes >= 0 ? 'Superávit' : 'Déficit')
                ->color($balanceMes >= 0 ? 'success' : 'danger'),
            Stat::make('Cuotas pendientes', format_clp($pendienteTotal))
                ->description('Monto total por cobrar')
                ->color('warning'),
            Stat::make('Cuotas vencidas', (string) $vencidas)
                ->description('En mora')
                ->color('danger'),
            Stat::make('Vencen ≤30 días', (string) $porVencer30)
                ->description('Próximos vencimientos')
                ->color('info'),
        ];
    }
}
