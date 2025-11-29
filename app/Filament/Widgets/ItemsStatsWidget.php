<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Item;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ItemsStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 3;

    public function getColumns(): int|array
    {
        return 4;
    }

    protected function getStats(): array
    {
        // $totalItems = Item::count();
        $activeItems = Item::where('active', true)->count();
        $inactiveItems = Item::where('active', false)->count();
        $availableItems = Item::where('active', true)->whereDoesntHave('activeAssignment')->count();
        $assignedItems = Item::where('active', true)->whereHas('activeAssignment')->count();

        // Stats por categoría (las 3 principales)
        $topCategories = Category::withCount('items')
            ->orderBy('items_count', 'desc')
            ->take(3)
            ->get();

        $stats = [
            // Stat::make('Total Items', $totalItems)
            //     ->description('All inventory items')
            //     ->descriptionIcon('heroicon-m-archive-box')
            //     ->color('primary'),

            Stat::make('Artículos Activos', $activeItems)
                ->description('Disponibles en inventario')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Artículos Inactivos', $inactiveItems)
                ->description('Artículos deshabilitados')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Artículos Disponibles', $availableItems)
                ->description('Listos para asignación')
                ->descriptionIcon('heroicon-m-hand-raised')
                ->color('info'),

            Stat::make('Artículos Asignados', $assignedItems)
                ->description('Actualmente en uso')
                ->descriptionIcon('heroicon-m-user-circle')
                ->color('warning'),
        ];

        // Agregar las top 3 categorías dinámicamente
        // foreach ($topCategories as $index => $category) {
        //     $colors = ['info', 'success', 'warning'];
        //     $stats[] = Stat::make($category->name, $category->items_count)
        //         ->description('Items in category')
        //         ->descriptionIcon('heroicon-m-tag')
        //         ->color($colors[$index] ?? 'gray');
        // }

        return $stats;
    }
}
