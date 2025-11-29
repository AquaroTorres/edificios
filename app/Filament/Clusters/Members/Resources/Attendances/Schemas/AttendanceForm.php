<?php

namespace App\Filament\Clusters\Members\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required(),
                TextInput::make('subject')
                    ->label('Asunto')
                    ->required()
                    ->columnSpan(3),
            ])
            ->columns(4);
    }
}
