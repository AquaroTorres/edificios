<?php

namespace App\Filament\Clusters\Inventory\Resources\Items\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable()
                    ->icon(fn ($record): ?Heroicon => $record->trashed() ? Heroicon::OutlinedTrash : null),
                TextColumn::make('price')
                    ->label('Precio')
                    ->numeric(
                        decimalPlaces: 0,
                        decimalSeparator: ',',
                        thousandsSeparator: '.',
                    )
                    ->prefix('$')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('location.name')
                    ->label('Ubicación')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(Color::Gray)
                    ->placeholder('Sin ubicación'),
                TextColumn::make('activeAssignment.user.name')
                    ->label('Asignado a')
                    ->searchable()
                    ->sortable()
                    ->color('primary')
                    ->placeholder('Disponible'),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('availability')
                    ->label('Disponibilidad')
                    ->options([
                        'available' => 'Disponible',
                        'assigned' => 'Actualmente Asignado',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] === 'available',
                            fn (Builder $query): Builder => $query->whereDoesntHave('activeAssignment'),
                        )->when(
                            $data['value'] === 'assigned',
                            fn (Builder $query): Builder => $query->whereHas('activeAssignment'),
                        );
                    }),
                TrashedFilter::make(),
            ])
            ->recordActions([
                // ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
