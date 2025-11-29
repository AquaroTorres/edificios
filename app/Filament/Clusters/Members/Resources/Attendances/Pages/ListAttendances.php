<?php

namespace App\Filament\Clusters\Members\Resources\Attendances\Pages;

use App\Filament\Clusters\Members\Resources\Attendances\AttendanceResource;
use App\Filament\Clusters\Members\Resources\Attendances\Widgets\TopAttendancesWidget;
use App\Models\Attendance;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->label('Crear asistencia')
                ->action(function () {
                    $attendance = Attendance::create([
                        'date' => now()->format('Y-m-d'),
                        'subject' => 'Asistencia '.now()->format('d/m/Y'),
                        'created_by' => auth()->id(),
                    ]);

                    return redirect()->to(AttendanceResource::getUrl('edit', ['record' => $attendance]));
                }),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            TopAttendancesWidget::class,
        ];
    }
}
