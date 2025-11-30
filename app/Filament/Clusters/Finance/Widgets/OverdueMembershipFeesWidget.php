<?php

namespace App\Filament\Clusters\Finance\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class OverdueMembershipFeesWidget extends TableWidget
{
    protected static ?string $heading = 'Cuotas Vencidas';

    public function table(Table $table): Table
    {
        return $table;
    }
}
