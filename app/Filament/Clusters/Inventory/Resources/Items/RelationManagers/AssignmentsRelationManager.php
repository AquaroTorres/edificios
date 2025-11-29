<?php

namespace App\Filament\Clusters\Inventory\Resources\Items\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';

    protected static ?string $recordTitleAttribute = 'user.name';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Asignado a')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                DateTimePicker::make('assigned_at')
                    ->label('Fecha de Asignación')
                    ->default(now())
                    ->required(),
                DateTimePicker::make('returned_at')
                    ->label('Fecha de Devolución'),
                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(3)
                    ->columnSpanFull(),
                Hidden::make('assigned_by')
                    ->default(Auth::id()),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user.name')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Asignado a')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-clock')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('warning')
                    ->falseColor('success')
                    ->getStateUsing(fn ($record) => is_null($record->returned_at)),
                TextColumn::make('assigned_at')
                    ->label('Asignado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('returned_at')
                    ->label('Devuelto')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Aún asignado'),
                TextColumn::make('assignedBy.name')
                    ->label('Asignado por')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('notes')
                    ->label('Notas')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'active' => 'Actualmente Asignado',
                        'returned' => 'Devuelto',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] === 'active',
                            fn (Builder $query): Builder => $query->whereNull('returned_at'),
                        )->when(
                            $data['value'] === 'returned',
                            fn (Builder $query): Builder => $query->whereNotNull('returned_at'),
                        );
                    }),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Asignar Artículo'),
            ])
            ->recordActions([
                Action::make('return')
                    ->label('Devolver')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->returned_at))
                    ->action(function ($record) {
                        $record->update([
                            'returned_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Artículo devuelto exitosamente')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Devolver Artículo')
                    ->modalDescription('¿Estás seguro de que quieres marcar este artículo como devuelto?'),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('assigned_at', 'desc');
    }
}
