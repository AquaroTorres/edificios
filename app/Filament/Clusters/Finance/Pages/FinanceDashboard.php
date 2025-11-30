<?php

namespace App\Filament\Clusters\Finance\Pages;

use App\Filament\Clusters\Finance\FinanceCluster;
use App\Filament\Clusters\Finance\Widgets;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class FinanceDashboard extends Page
{
    protected static ?string $cluster = FinanceCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartLine;

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = 'Dashboard Financiero';

    public static function canAccess(): bool
    {
        return auth()->user()->is_admin || auth()->user()->is_super_admin;
    }

    public function getHeaderWidgets(): array
    {
        return [
            // Widgets\FinanceKpisWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            // Widgets\FinanceIncomeByTypeWidget::class,
            // Widgets\ExpensesByTypeWidget::class,
            // Widgets\OverdueMembershipFeesWidget::class,
        ];
    }
}
