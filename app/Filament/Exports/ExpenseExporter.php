<?php

namespace App\Filament\Exports;

use App\Models\Expense;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ExpenseExporter extends Exporter
{
    protected static ?string $model = Expense::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('amount')
                ->label('Monto'),
            ExportColumn::make('concept')
                ->label('Concepto'),
            ExportColumn::make('date')
                ->label('Fecha'),
            ExportColumn::make('user.name')
                ->label('Usuario'),
            ExportColumn::make('expenseType.name')
                ->label('Tipo de Gasto'),
            ExportColumn::make('notes')
                ->label('Notas'),
            ExportColumn::make('user.name')
                ->label('Usuario'),
            ExportColumn::make('created_at')
                ->label('Fecha de Creación'),
            ExportColumn::make('updated_at')
                ->label('Fecha de Actualización'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your expense export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
