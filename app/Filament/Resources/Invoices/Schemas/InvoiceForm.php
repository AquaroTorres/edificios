<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('billing_period_id')
                    ->required()
                    ->numeric(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('subtotal_common')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('reserve_percent')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('reserve_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('mora_percent')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('mora_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_to_pay')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                TextInput::make('number')
                    ->default(null),
                DateTimePicker::make('due_date'),
            ]);
    }
}
