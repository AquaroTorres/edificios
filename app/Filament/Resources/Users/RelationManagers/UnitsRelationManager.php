<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Units\UnitResource;
use Filament\Actions\AssociateAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UnitsRelationManager extends RelationManager
{
    protected static string $relationship = 'units';

    protected static ?string $relatedResource = UnitResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                AssociateAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->whereNull('user_id')
                    ),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Editar'),
                DissociateAction::make()
                    ->label('Desvincular'),
            ]);
    }
}
