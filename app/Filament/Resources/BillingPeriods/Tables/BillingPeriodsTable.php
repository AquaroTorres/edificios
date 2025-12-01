<?php

namespace App\Filament\Resources\BillingPeriods\Tables;

use App\Models\BillingPeriod;
use App\Models\Expense;
use App\Models\Invoice;
use App\Services\BillingGenerator;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BillingPeriodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('month')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('opened_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('closed_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_expenses')
                    ->label('Total Gastos')
                    ->state(function (BillingPeriod $record) {
                        return (string) Expense::query()->where('billing_period_id', $record->id)->sum('amount');
                    })
                    ->money('CLP')
                    ->sortable(false),
                TextColumn::make('total_invoices')
                    ->label('Total Facturado')
                    ->state(function (BillingPeriod $record) {
                        return (string) Invoice::query()->where('billing_period_id', $record->id)->sum('subtotal_common');
                    })
                    ->money('CLP')
                    ->sortable(false),
                TextColumn::make('difference')
                    ->label('Diferencia')
                    ->state(function (BillingPeriod $record) {
                        $expenses = (float) Expense::query()->where('billing_period_id', $record->id)->sum('amount');
                        $invoices = (float) Invoice::query()->where('billing_period_id', $record->id)->sum('subtotal_common');

                        return number_format($expenses - $invoices, 2, '.', '');
                    })
                    ->color(fn ($state) => ((float) $state === 0.0) ? 'success' : 'danger')
                    ->sortable(false),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('generar')
                    ->label('Generar')
                    ->color('primary')
                    ->form([
                        Toggle::make('dry_run')->label('Dry run')->default(false),
                        Toggle::make('rebuild')->label('Rebuild')->default(false),
                    ])
                    ->action(function (array $data, BillingPeriod $record) {
                        $dryRun = (bool) ($data['dry_run'] ?? false);
                        $rebuild = (bool) ($data['rebuild'] ?? false);

                        if ($rebuild && ! $dryRun) {
                            // Purge existing invoices & allocations for this period
                            \App\Models\InvoiceLine::query()->whereIn('invoice_id', function ($q) use ($record) {
                                $q->select('id')->from('invoices')->where('billing_period_id', $record->id);
                            })->delete();
                            \App\Models\Invoice::query()->where('billing_period_id', $record->id)->delete();
                            \App\Models\AllocationLine::query()->whereIn('allocation_id', function ($q) use ($record) {
                                $q->select('id')->from('allocations')->where('billing_period_id', $record->id);
                            })->delete();
                            \App\Models\Allocation::query()->where('billing_period_id', $record->id)->delete();
                        }

                        /** @var BillingGenerator $generator */
                        $generator = app(BillingGenerator::class);
                        $generator->generate($record->year, $record->month, $dryRun);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
