<?php

namespace App\Filament\Clusters\Members\Resources\Users\Tables;

use App\Enums\MembershipStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->circular()
                    ->disk('public')
                    ->alignCenter(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->icon(fn ($record): ?Heroicon => $record->trashed() ? Heroicon::OutlinedTrash : null),
                TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable(),
                TextColumn::make('userType.name')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('birth_date')
                    ->label('Fecha de nacimiento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('join_date')
                    ->label('Fecha de ingreso')
                    ->date('d/m/Y')
                    ->sortable(),
                // IconColumn::make('is_active')
                //     ->label('Activo')
                //     ->boolean(),
                IconColumn::make('is_admin')
                    ->label('Administrador')
                    ->trueIcon(Heroicon::Star)
                    ->falseColor(Color::Gray)
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('membership_status')
                    ->label('Estado de membresía')
                    ->sortable()
                    ->searchable()
                    ->badge(),
                TextColumn::make('monthly_fee')
                    ->label('Cuota mensual')
                    ->numeric()
                    ->prefix('$')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('user_type_id')
                    ->relationship('userType', 'name')
                    ->label('Tipo de usuario'),
                SelectFilter::make('membership_status')
                    ->label('Estado')
                    ->options(MembershipStatus::class),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn ($record) => $record->id !== 1),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function ($records) {
                            // Filtrar para no eliminar el registro con id 1
                            $records->reject(fn ($record) => $record->id === 1)->each->delete();
                        }),
                ]),
            ])
            ->defaultSort('name');
    }
}
