<?php

namespace App\Filament\Clusters\Finance\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required()
                    ->default(now()),
                TextInput::make('concept')
                    ->label('Concepto')
                    ->columnSpan(3)
                    ->required(),
                TextInput::make('amount')
                    ->label('Monto')
                    ->required()
                    ->numeric(),
                Select::make('expense_type_id')
                    ->label('Tipo de Gasto')
                    ->relationship('expenseType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->label('Usuario')
                    ->helperText('Usuario que registra el gasto')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpan(2)
                    ->default(auth()->id()),
                TextInput::make('notes')
                    ->label('Notas')
                    ->columnSpan(4),
                FileUpload::make('file_path')
                    ->label('Archivo adjunto')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->directory('expenses')
                    ->visibility('private')
                    ->downloadable()
                    ->openable()
                    ->nullable()
                    ->columnSpanFull(),
            ])
            ->columns(6);
    }
}
