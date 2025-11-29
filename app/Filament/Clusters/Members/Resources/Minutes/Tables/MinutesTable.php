<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MinutesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('creator.name')
                    ->label('Creador')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('body')
                    ->label('Contenido')
                    ->html()
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('minuteType.name')
                    ->label('Tipo de acta')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_public')
                    ->label('¿Público?')
                    ->boolean()
                    ->visible(fn () => auth()->user()?->is_admin || auth()->user()?->is_super_admin),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // filtro por MinuteType
                SelectFilter::make('minute_type_id')
                    ->relationship('minuteType', 'name')
                    ->label('Tipo de acta'),
                // filtro por creador
                SelectFilter::make('created_by')
                    ->relationship('creator', 'name')
                    ->searchable()
                    ->label('Creador'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
    }
}
