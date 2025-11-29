<?php

namespace App\Filament\Clusters\Finance\Resources\Incomes\Schemas;

use App\Enums\PaymentMechanism;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class IncomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Fecha')
                    ->default(now())
                    ->required(),
                TextInput::make('concept')
                    ->label('Concepto')
                    ->required()
                    ->columnSpan(3),
                TextInput::make('amount')
                    ->label('Monto')
                    ->required()
                    ->numeric(),
                Select::make('income_type_id')
                    ->label('Tipo de Ingreso')
                    ->relationship('incomeType', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn ($record) => $record !== null && $record->income_type_id === 2),
                Select::make('user_id')
                    ->label('Pagado por')
                    ->relationship('user', 'name', modifyQueryUsing: function ($query) {
                        $query->where('membership_status', 'activo');
                    })
                    ->searchable()
                    ->columnSpan(2)
                    ->disabled(fn ($record) => $record !== null && $record->income_type_id === 2),
                Select::make('receiver_id')
                    ->label('Recibido por')
                    ->relationship('receiver', 'name')
                    ->searchable()
                    ->default(auth()->id())
                    ->columnSpan(2)
                    ->required(),
                ToggleButtons::make('mechanism')
                    ->label('Mecanismo de pago')
                    ->options(PaymentMechanism::class)
                    ->inline()
                    ->required(),
                TextInput::make('notes')
                    ->label('Notas')
                    ->columnSpan(4),
                FileUpload::make('file_path')
                    ->label('Archivo adjunto')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->directory('incomes')
                    ->visibility('private')
                    ->downloadable()
                    ->openable()
                    ->nullable()
                    ->columnSpanFull(),
            ])
            ->columns(6);
    }
}
