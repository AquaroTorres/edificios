<?php

namespace App\Filament\Clusters\Members\Resources\Attendances\Widgets;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TopAttendancesWidget extends TableWidget
{
    protected static ?string $heading = 'Ranking de Asistencias';

    // colspan
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => $this->getAttendanceRankingQuery())
            ->columns([
                TextColumn::make('position')
                    ->label('#')
                    ->sortable(false)
                    ->getStateUsing(fn ($rowLoop) => $rowLoop->iteration),
                TextColumn::make('name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_attendances')
                    ->label('Total Convocatorias')
                    ->numeric()
                    ->sortable()
                    ->badge(),
                TextColumn::make('attended_count')
                    ->label('Asistió')
                    ->numeric()
                    ->sortable()
                    ->color('success'),
                TextColumn::make('absent_count')
                    ->label('Ausente')
                    ->numeric()
                    ->sortable()
                    ->color('danger'),
                TextColumn::make('attendance_percentage')
                    ->label('% Asistencia')
                    ->formatStateUsing(fn ($state) => number_format($state, 1).'%')
                    ->sortable()
                    ->color(fn ($state) => match (true) {
                        $state >= 80 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    }),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')
                            ->label('Desde')
                            ->default(now()->startOfYear()),
                        DatePicker::make('until')
                            ->label('Hasta')
                            ->default(now()),
                    ]),
            ])
            ->defaultSort('attended_count', 'desc')
            ->paginated([10, 25, 50, 100]);
    }

    protected function getAttendanceRankingQuery(): Builder
    {
        // Obtener valores del filtro
        $filterState = $this->tableFilters['date_range'] ?? [];
        $fromDate = $filterState['from'] ?? now()->startOfYear();
        $untilDate = $filterState['until'] ?? now();

        $query = User::query()
            ->select([
                'users.id',
                'users.name',
                DB::raw('COUNT(attendance_user.id) as total_attendances'),
                DB::raw('SUM(CASE WHEN attendance_user.attended = 1 THEN 1 ELSE 0 END) as attended_count'),
                DB::raw('SUM(CASE WHEN attendance_user.attended = 0 THEN 1 ELSE 0 END) as absent_count'),
                DB::raw('ROUND((SUM(CASE WHEN attendance_user.attended = 1 THEN 1 ELSE 0 END) * 100.0) / NULLIF(COUNT(attendance_user.id), 0), 2) as attendance_percentage'),
            ])
            ->join('attendance_user', 'users.id', '=', 'attendance_user.user_id')
            ->join('attendances', 'attendance_user.attendance_id', '=', 'attendances.id')
            ->whereNull('attendances.deleted_at')
            ->groupBy('users.id', 'users.name')
            ->having('total_attendances', '>', 0);

        // Aplicar filtro de fechas si están configurados
        if ($fromDate) {
            $query->where('attendances.date', '>=', $fromDate);
        }

        if ($untilDate) {
            $query->where('attendances.date', '<=', $untilDate);
        }

        return $query;
    }
}
