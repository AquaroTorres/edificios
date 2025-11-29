<?php

namespace App\Filament\Clusters\Inventory\Resources\Items\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Código')
                    ->required()
                    ->unique()
                    ->placeholder('Ej: AB1234')
                    ->helperText('Código único del artículo'),
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('price')
                    ->label('Precio')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->default(null)
                    ->columnSpan(3),

                Select::make('location_id')
                    ->label('Ubicación')
                    ->relationship('location', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload()
                    ->helperText('Opcional: Asignar este artículo a una ubicación específica'),

                Section::make('Multimedia')
                    ->schema([
                        FileUpload::make('photo_path')
                            ->label('Foto Principal')
                            ->image()
                            ->disk('public')
                            ->directory('items/photos')
                            ->nullable()
                            ->imageEditor()
                            ->columnSpanFull(),

                        Repeater::make('files')
                            ->label('Archivos Adjuntos')
                            ->relationship('files')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nombre del Archivo')
                                    ->required()
                                    ->placeholder('Ej: Manual de usuario.pdf'),
                                FileUpload::make('path')
                                    ->label('Archivo')
                                    ->disk('public')
                                    ->directory('items/files')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Agregar archivo')
                            ->columnSpanFull()
                            ->collapsible(),
                    ])->columnSpan(3),
                Toggle::make('active')
                    ->label('Activo')
                    ->default(true)
                    ->helperText('Solo los artículos activos estarán disponibles para asignación'),

            ])
            ->columns(4);
    }
}
