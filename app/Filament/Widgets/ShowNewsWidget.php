<?php

namespace App\Filament\Widgets;

use App\Models\News;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ShowNewsWidget extends BaseWidget
{
    protected static ?string $heading = 'Últimas noticias';

    protected static ?string $pollingInterval = '260s'; // refresco automático opcional

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getQuery())
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('title')
                        ->label('Título')
                        ->weight('bold')
                        ->size('lg')
                        ->wrap(),

                    Tables\Columns\ImageColumn::make('photo_path')
                        ->label('Foto')
                        ->height(200)
                        ->width(300)
                        ->disk('public')
                        ->defaultImageUrl('https://ui-avatars.com/api/?size=300&name=📷')
                        ->extraAttributes(['class' => 'rounded-lg shadow-sm']),

                    Tables\Columns\TextColumn::make('body')
                        ->label('Contenido')
                        ->html(),

                    Tables\Columns\TextColumn::make('link')
                        ->label('Ver más')
                        ->url(fn ($record) => $record->link)
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->color('primary')
                        ->visible(fn ($record) => ! empty($record->link))
                        ->extraAttributes(['class' => 'mt-2']),

                    Tables\Columns\TextColumn::make('created_at')
                        ->label('Publicado')
                        ->dateTime('d/m/Y H:i')
                        ->color('gray')
                        ->size('sm')
                        ->extraAttributes(['class' => 'mt-1']),
                ])
                    ->space(3)
                    ->extraAttributes(['class' => 'p-4 border rounded-lg bg-white shadow-sm']),
            ])
            ->contentGrid([
                'md' => 3,
                'sm' => 1,
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false)
            ->emptyStateHeading('No hay noticias todavía')
            ->emptyStateDescription('Cuando registres noticias publicadas aparecerán aquí.')
            ->emptyStateIcon('heroicon-o-bell-alert');
    }

    protected function getQuery(): Builder
    {
        return News::query()
            ->orderByDesc('created_at')
            ->limit(3);
    }
}
