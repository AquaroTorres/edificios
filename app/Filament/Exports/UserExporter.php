<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name')
                ->label('Nombre'),
            ExportColumn::make('email')
                ->label('Correo Electrónico'),
            ExportColumn::make('phone')
                ->label('Teléfono'),
            ExportColumn::make('birth_date')
                ->label('Fecha de Nacimiento'),
            ExportColumn::make('join_date')
                ->label('Fecha de Ingreso'),
            ExportColumn::make('gender')
                ->label('Sexo')
                ->formatStateUsing(fn ($state) => $state?->getLabel()),
            ExportColumn::make('address')
                ->label('Dirección'),
            ExportColumn::make('commune.name')
                ->label('Comuna'),
            ExportColumn::make('userType.name')
                ->label('Tipo de Usuario'),
            ExportColumn::make('is_active')
                ->label('Activo')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('is_admin')
                ->label('Administrador')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('membership_status')
                ->label('Estado de Membresía')
                ->formatStateUsing(fn ($state) => $state?->getLabel()),
            ExportColumn::make('baptism')
                ->label('Bautismo')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('initiation')
                ->label('Iniciación')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('confirmation')
                ->label('Confirmación')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('row_position')
                ->label('Posición en Fila')
                ->formatStateUsing(fn ($state) => $state?->getLabel()),
            ExportColumn::make('health_background')
                ->label('Antecedentes de Salud'),
            ExportColumn::make('created_at')
                ->label('Fecha de Creación'),
            ExportColumn::make('updated_at')
                ->label('Fecha de Actualización'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
