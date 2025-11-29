<?php

namespace App\Filament\Clusters\Finance\Widgets;

use App\Enums\MembershipFeeStatus;
use App\Models\MembershipFee;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class OverdueMembershipFeesWidget extends TableWidget
{
    protected static ?string $heading = 'Cuotas Vencidas';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => MembershipFee::query()
                ->with('user')
                ->where('status', MembershipFeeStatus::Vencido)
                ->orderBy('due_at')
            )
            ->columns([
                TextColumn::make('user.name')->label('Usuario')->searchable(),
                TextColumn::make('concept')->label('Concepto')->limit(30),
                TextColumn::make('due_at')->label('Vencimiento')->date('d/m/Y'),
                TextColumn::make('pending_amount')
                    ->label('Pendiente')
                    ->money('CLP')
                    ->color('danger')
                    ->alignEnd(),
            ])
            ->defaultPaginationPageOption(10)
            ->paginated(true);
    }
}
