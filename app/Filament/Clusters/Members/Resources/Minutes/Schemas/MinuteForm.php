<?php

namespace App\Filament\Clusters\Members\Resources\Minutes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MinuteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(3),
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required()
                    ->default(now()),
                Select::make('minute_type_id')
                    ->label('Tipo de Acta')
                    ->relationship('minuteType', 'name')
                    ->default(1)
                    ->nullable(),
                Toggle::make('is_public')
                    ->label('¿Público?')
                    ->default(true)
                    ->inline(false),
                RichEditor::make('body')
                    ->label('Cuerpo del Acta')
                    ->required()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->columnSpanFull(),
                // Repeater::make('attendees')
                //     ->label('Asistentes')
                //     ->relationship()
                //     ->columns([
                //         'Miembro',
                //         'Asistió',
                //     ])
                //     ->records(function () {
                //         return \App\Models\User::all();
                //     })
                //     ->schema([
                //         TextInput::make('user_name')
                //             ->label('Miembro')
                //             ->disabled()
                //             ->default(fn ($record) => $record->name),
                //         Toggle::make('attended')
                //             ->label('Asistió')
                //             ->default(false),
                //     ]),
            ])
            ->columns(6);
    }
}
