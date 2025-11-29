<?php

namespace App\Filament\Clusters\Finance\Widgets;

use App\Models\IncomeType;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class FinanceIncomeByTypeWidget extends TableWidget
{
    protected static ?string $heading = 'Ingresos por Tipo';

    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => IncomeType::query()
                ->withSum(['incomes' => function ($query) {
                    $dateFromFilter = $this->getTableFilterState('date_range')['date_from'] ?? null;
                    $dateToFilter = $this->getTableFilterState('date_range')['date_to'] ?? null;

                    if ($dateFromFilter) {
                        $query->whereDate('date', '>=', $dateFromFilter);
                    }
                    if ($dateToFilter) {
                        $query->whereDate('date', '<=', $dateToFilter);
                    }
                }], 'amount')
                ->withCount(['incomes' => function ($query) {
                    $dateFromFilter = $this->getTableFilterState('date_range')['date_from'] ?? null;
                    $dateToFilter = $this->getTableFilterState('date_range')['date_to'] ?? null;

                    if ($dateFromFilter) {
                        $query->whereDate('date', '>=', $dateFromFilter);
                    }
                    if ($dateToFilter) {
                        $query->whereDate('date', '<=', $dateToFilter);
                    }
                }])
                ->orderBy('incomes_sum_amount', 'desc')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Tipo de Ingreso')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('incomes_count')
                    ->label('Cantidad de Registros')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('incomes_sum_amount')
                    ->label('Monto Total')
                    ->money('CLP')
                    ->sortable()
                    ->alignEnd()
                    ->summarize([
                        Sum::make()
                            ->money('CLP')
                            ->label('Total General'),
                    ]),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('date_from')
                            ->label('Fecha Desde'),
                        DatePicker::make('date_to')
                            ->label('Fecha Hasta'),
                    ])
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['date_from'] && ! $data['date_to']) {
                            return null;
                        }

                        $from = $data['date_from'] ? \Carbon\Carbon::parse($data['date_from'])->format('d/m/Y') : 'inicio';
                        $to = $data['date_to'] ? \Carbon\Carbon::parse($data['date_to'])->format('d/m/Y') : 'fin';

                        return "Desde {$from} hasta {$to}";
                    }),
            ])
            ->defaultSort('incomes_sum_amount', 'desc')
            ->striped()
            ->paginated(false);
    }
}
