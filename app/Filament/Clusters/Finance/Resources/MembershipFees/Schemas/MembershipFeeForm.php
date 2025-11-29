<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\Schemas;

use App\Enums\MembershipFeeStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class MembershipFeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Usuario')
                    ->searchable()
                    ->preload(),
                TextInput::make('amount')
                    ->label('Monto')
                    ->required()
                    ->numeric(),
                DatePicker::make('due_at')
                    ->label('Fecha de Vencimiento')
                    ->required(),
                DatePicker::make('paid_at')
                    ->label('Fecha de Pago'),
                ToggleButtons::make('status')
                    ->label('Estado')
                    ->options(
                        MembershipFeeStatus::class,
                    )
                    ->inline()
                    ->nullable()
                    ->columnSpan(2),
            ])
            ->columns(4);
    }
}
