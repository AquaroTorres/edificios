<?php

namespace App\Filament\Resources\Units\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('correlative')
                    ->label('Correlativo')
                    ->searchable(),
                TextColumn::make('user.company')
                    ->label('Propietario (Empresa)')
                    ->placeholder('Sin propietario')
                    ->searchable(),
                TextColumn::make('unitType.name')
                    ->label('Tipo de Unidad')
                    ->searchable(),
                TextColumn::make('number')
                    ->label('Número')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('floor')
                    ->label('Piso')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rol')
                    ->label('ROL')
                    ->searchable(),
                TextColumn::make('surface')
                    ->label('Superficie')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('proration')
                    ->label('Prorrateo')
                    ->numeric(2)
                    ->formatStateUsing(fn ($state): string => number_format($state, 3))
                    ->sortable()
                    ->suffix('%')
                    ->summarize(
                        Sum::make()
                            ->label('Total % prorrateo')
                            ->numeric(2)
                            ->formatStateUsing(fn ($state): string => number_format($state, 2))
                            ->suffix('%')
                    ),
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
                TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Eliminar seleccionados'),
                ]),
            ])
            ->paginationPageOptions([100]);
    }
}
