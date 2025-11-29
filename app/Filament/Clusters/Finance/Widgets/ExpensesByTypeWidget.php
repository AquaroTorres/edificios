<?php

namespace App\Filament\Clusters\Finance\Widgets;

use App\Models\ExpenseType;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpensesByTypeWidget extends TableWidget
{
    protected static ?string $heading = 'Gastos por Tipo';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => ExpenseType::query()
                ->withSum(['expenses' => function ($query) {
                    $dateFrom = $this->getTableFilterState('date_range')['date_from'] ?? null;
                    $dateTo = $this->getTableFilterState('date_range')['date_to'] ?? null;

                    if ($dateFrom) {
                        $query->whereDate('date', '>=', $dateFrom);
                    }
                    if ($dateTo) {
                        $query->whereDate('date', '<=', $dateTo);
                    }
                }], 'amount')
                ->withCount(['expenses' => function ($query) {
                    $dateFrom = $this->getTableFilterState('date_range')['date_from'] ?? null;
                    $dateTo = $this->getTableFilterState('date_range')['date_to'] ?? null;

                    if ($dateFrom) {
                        $query->whereDate('date', '>=', $dateFrom);
                    }
                    if ($dateTo) {
                        $query->whereDate('date', '<=', $dateTo);
                    }
                }])
                ->orderBy('expenses_sum_amount', 'desc')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Tipo de Gasto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('expenses_count')
                    ->label('Cantidad')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('expenses_sum_amount')
                    ->label('Monto Total')
                    ->money('CLP')
                    ->alignEnd()
                    ->sortable()
                    ->summarize([
                        Sum::make()->money('CLP')->label('Total General'),
                    ]),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('date_from')->label('Fecha Desde'),
                        DatePicker::make('date_to')->label('Fecha Hasta'),
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
            ->defaultSort('expenses_sum_amount', 'desc')
            ->striped()
            ->paginated(false);
    }
}
