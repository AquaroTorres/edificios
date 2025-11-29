<?php

namespace App\Filament\Clusters\Members\Resources\News\Tables;

use App\Notifications\NewsNotification;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->size(60)
                    ->circular()
                    ->disk('public')
                    ->defaultImageUrl('https://ui-avatars.com/api/?size=300&name=📷'),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->size('md'),

                // TextColumn::make('body')
                //     ->label('Contenido')
                //     ->html()
                //     ->limit(100)
                //     ->wrap()
                //     ->tooltip(function (TextColumn $column): ?string {
                //         $state = $column->getState();
                //         if (strlen($state) <= 100) {
                //             return null;
                //         }

                //         return strip_tags($state);
                //     }),

                TextColumn::make('link')
                    ->label('Enlace')
                    ->url(fn (string $state): string => $state)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-link')
                    ->limit(50)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('creator.name')
                    ->label('Creador')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                Action::make('enviarATodos')
                    ->label('Enviar a todos')
                    ->icon('heroicon-o-paper-airplane')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        auth()->user()->notify(new NewsNotification($record));
                        Notification::make()
                            ->title('Cuotas generadas')
                            ->body('Falta configurar los meses para la generación de cuotas.')
                            ->danger()
                            ->send();
                    })
                    ->color('primary')
                    ->visible(auth()->user()->is_admin || auth()->user()->is_super_admin),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
