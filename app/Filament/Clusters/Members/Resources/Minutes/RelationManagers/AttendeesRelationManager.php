<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\RelationManagers;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AttendeesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendees';

    protected static ?string $title = 'Asistentes';

    protected static ?string $modelLabel = 'asistente';

    protected static ?string $pluralModelLabel = 'asistentes';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('run')
                    ->searchable(),
                ToggleColumn::make('pivot.attended')
                    ->label('Asistió')
                    ->updateStateUsing(function ($record, $state) {
                        $minute = $this->getOwnerRecord();
                        $minute->attendees()->updateExistingPivot($record->id, ['attended' => $state]);
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('attach_all')
                    ->label('Crear asistencia')
                    ->action(function () {
                        $minute = $this->getOwnerRecord();
                        $allUsers = User::where('membership_status', 'activo')
                            ->where('is_super_admin', false)
                            ->get();
                        foreach ($allUsers as $user) {
                            $minute->attendees()->syncWithoutDetaching([$user->id => ['attended' => false]]);
                        }
                    }),
            ])
            ->recordActions([
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ])
            ->defaultSort('name')
            ->paginationPageOptions([100]);
    }
}
