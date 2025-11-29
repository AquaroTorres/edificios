<?php

namespace App\Filament\Clusters\Members\Resources\Attendances;

use App\Filament\Clusters\Members\MembersCluster;
use App\Filament\Clusters\Members\Resources\Attendances\Pages\CreateAttendance;
use App\Filament\Clusters\Members\Resources\Attendances\Pages\EditAttendance;
use App\Filament\Clusters\Members\Resources\Attendances\Pages\ListAttendances;
use App\Filament\Clusters\Members\Resources\Attendances\Pages\ViewAttendance;
use App\Filament\Clusters\Members\Resources\Attendances\Schemas\AttendanceForm;
use App\Filament\Clusters\Members\Resources\Attendances\Schemas\AttendanceInfolist;
use App\Filament\Clusters\Members\Resources\Attendances\Tables\AttendancesTable;
use App\Filament\Clusters\Members\Resources\Minutes\RelationManagers\AttendeesRelationManager;
use App\Models\Attendance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $cluster = MembersCluster::class;

    protected static ?string $recordTitleAttribute = 'subject';

    protected static ?string $navigationLabel = 'Asistencias';

    protected static ?string $modelLabel = 'asistencia';

    protected static ?string $pluralModelLabel = 'asistencias';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return AttendanceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AttendanceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AttendancesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AttendeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAttendances::route('/'),
            'create' => CreateAttendance::route('/create'),
            'view' => ViewAttendance::route('/{record}'),
            'edit' => EditAttendance::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            Widgets\TopAttendancesWidget::class,
        ];
    }
}
