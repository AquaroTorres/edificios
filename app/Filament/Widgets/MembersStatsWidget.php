<?php

namespace App\Filament\Widgets;

use App\Enums\MembershipStatus;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MembersStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    public function getColumns(): int|array
    {
        return 4;
    }

    protected function getStats(): array
    {
        $totalMembers = User::where('is_super_admin', false)->count();
        // $activeMembers = User::where('is_active', true)->count();
        // $inactiveMembers = User::where('is_active', false)->count();

        // Stats por estado de membresía
        $activeMembershipStatus = User::where('membership_status', MembershipStatus::Activo)->where('is_super_admin', false)->count();
        $inactiveMembershipStatus = User::where('membership_status', MembershipStatus::Inactivo)->where('is_super_admin', false)->count();
        $suspendedMembers = User::where('membership_status', MembershipStatus::Suspendido)->where('is_super_admin', false)->count();

        $femaleMembers = User::where('is_super_admin', false)->where('gender', 'Femenino')->count();
        $maleMembers = User::where('is_super_admin', false)->where('gender', 'Masculino')->count();

        $currentYear = now()->year;
        $newMembers = User::where('is_super_admin', false)
            ->whereYear('join_date', $currentYear)
            ->count();

        $oldMembers = User::where('is_super_admin', false)
            ->where('join_date', '<', now()->startOfYear())
            ->count();

        return [
            Stat::make('Total de Miembros', $totalMembers)
                ->description('Todos los miembros registrados')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            // Stat::make('Active Members', $activeMembers)
            //     ->description('Currently active users')
            //     ->descriptionIcon('heroicon-m-check-circle')
            //     ->color('success'),

            // Stat::make('Inactive Members', $inactiveMembers)
            //     ->description('Not currently active users')
            //     ->descriptionIcon('heroicon-m-x-circle')
            //     ->color('danger'),

            Stat::make('Membresía Activa', $activeMembershipStatus)
                ->description('Estado de membresía activa')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('success'),

            Stat::make('Miembros Suspendidos', $suspendedMembers)
                ->description('Membresía suspendida')
                ->descriptionIcon('heroicon-m-no-symbol')
                ->color('warning'),

            Stat::make('Membresía Inactiva', $inactiveMembershipStatus)
                ->description('Estado de membresía inactiva')
                ->descriptionIcon('heroicon-m-shield-exclamation')
                ->color('gray'),

            Stat::make('Miembros Mujeres', $femaleMembers)
                ->description('Total género femenino')
                ->descriptionIcon('heroicon-m-user')
                ->color('info'),

            Stat::make('Miembros Hombres', $maleMembers)
                ->description('Total género masculino')
                ->descriptionIcon('heroicon-m-user')
                ->color('primary'),

            Stat::make('Miembros Nuevos', $newMembers)
                ->description('Ingresaron este año')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('success'),

            Stat::make('Miembros Antiguos', $oldMembers)
                ->description('Ingreso en años previos')
                ->descriptionIcon('heroicon-m-clock')
                ->color('secondary'),
        ];
    }
}
