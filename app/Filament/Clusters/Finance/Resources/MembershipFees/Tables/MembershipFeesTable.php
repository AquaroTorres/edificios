<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Tables;

use App\Enums\MembershipFeeStatus;
use App\Models\MembershipFee;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MembershipFeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable(),
                TextColumn::make('concept')
                    ->label('Concepto')
                    ->sortable(),
                TextColumn::make('year')
                    ->label('Año')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('period')
                    ->label('Período')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Monto')
                    ->numeric(
                        decimalPlaces: 0,
                        decimalSeparator: ',',
                        thousandsSeparator: '.',
                    )
                    ->prefix('$')
                    ->sortable(),
                TextColumn::make('paid_amount')
                    ->label('Pagado')
                    ->numeric(
                        decimalPlaces: 0,
                        decimalSeparator: ',',
                        thousandsSeparator: '.',
                    )
                    ->prefix('$')
                    ->sortable(),
                TextColumn::make('pending_amount')
                    ->label('Pendiente')
                    ->numeric(
                        decimalPlaces: 0,
                        decimalSeparator: ',',
                        thousandsSeparator: '.',
                    )
                    ->prefix('$')
                    ->sortable(query: function ($query, string $direction) {
                        return $query->orderByRaw("(amount - paid_amount) {$direction}");
                    })
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'success'),
                TextColumn::make('due_at')
                    ->label('F. Vencimiento')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('paid_at')
                    ->label('F. Pago')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->sortable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('concept')
                    ->label('Concepto')
                    ->options(
                        MembershipFee::query()
                            ->distinct()
                            ->pluck('concept', 'concept')
                    ),
                SelectFilter::make('period')
                    ->label('Período')
                    ->options(db_config('system.months_with_fees') ? array_combine(
                        explode(',', db_config('system.months_with_fees')),
                        array_map(
                            fn ($month) => "{$month}° cuota",
                            explode(',', db_config('system.months_with_fees'))
                        )
                    ) : []),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->multiple()
                    ->options(MembershipFeeStatus::class),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('due_at', 'desc');
    }
}
