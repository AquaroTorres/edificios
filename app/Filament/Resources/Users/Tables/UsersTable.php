<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('run')
                    ->label('RUN')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('join_date')
                    ->label('Fecha de Ingreso')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Cargo')
                    ->sortable(),
                TextColumn::make('membership_status')
                    ->label('Estado de Membresía')
                    ->sortable()
                    ->badge(),
            ])
            ->defaultSort('name');
    }
}
