<?php

namespace App\Filament\Exports;

use App\Models\Item;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ItemExporter extends Exporter
{
    protected static ?string $model = Item::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('code')
                ->label('Código'),
            ExportColumn::make('name')
                ->label('Nombre'),
            ExportColumn::make('description')
                ->label('Descripción'),
            ExportColumn::make('price')
                ->label('Precio'),
            ExportColumn::make('active')
                ->label('Activo')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('category.name')
                ->label('Categoría'),
            ExportColumn::make('location.name')
                ->label('Ubicación'),
            ExportColumn::make('activeAssignment.user.name')
                ->label('Último Usuario Asignado'),
            ExportColumn::make('activeAssignment.assigned_at')
                ->label('Fecha de Asignación'),
            ExportColumn::make('activeAssignment.returned_at')
                ->label('Fecha de Devolución'),
            ExportColumn::make('status')
                ->label('Estado')
                ->formatStateUsing(function ($record) {
                    if ($record->activeAssignment) {
                        return $record->activeAssignment->returned_at ? 'Devuelto' : 'Asignado';
                    }

                    return 'Disponible';
                }),
            ExportColumn::make('created_at')
                ->label('Fecha de Creación'),
            ExportColumn::make('updated_at')
                ->label('Fecha de Actualización'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your item export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
