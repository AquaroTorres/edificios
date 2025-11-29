<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Str;

class UserImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Nombre')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('run')
                ->label('RUN')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('email')
                ->label('Correo Electrónico'),
            ImportColumn::make('phone')
                ->label('Teléfono'),
            ImportColumn::make('birth_date')
                ->label('Fecha de Nacimiento'),
            ImportColumn::make('join_date')
                ->label('Fecha de Ingreso'),
            ImportColumn::make('gender')
                ->label('Sexo'),
            ImportColumn::make('address')
                ->label('Dirección'),
            ImportColumn::make('commune_id')
                ->label('Comuna'),
            ImportColumn::make('user_type_id')
                ->label('Tipo de Usuario'),
            ImportColumn::make('is_active')
                ->label('Activo'),
            ImportColumn::make('is_admin')
                ->label('Administrador'),
            ImportColumn::make('membership_status')
                ->label('Estado de Membresía'),
            ImportColumn::make('baptism')
                ->label('Bautismo'),
            ImportColumn::make('initiation')
                ->label('Iniciación'),
            ImportColumn::make('confirmation')
                ->label('Confirmación'),
            ImportColumn::make('row_position')
                ->label('Posición en Fila'),
            ImportColumn::make('health_background')
                ->label('Antecedentes de Salud'),
        ];
    }

    public function resolveRecord(): ?User
    {
        return User::firstOrNew([
            'run' => $this->data['run'],
        ]);

    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'La importación de usuarios ha finalizado. '.
            $import->successful_rows.' '.Str::plural('usuario', $import->successful_rows).' importados correctamente.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Str::plural('usuario', $failedRowsCount).' fallaron al importar.';
        }

        return $body;
    }
}
