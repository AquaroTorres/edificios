<?php

namespace App\Filament\Clusters\Finance\Resources\MembershipFees\RelationManagers;

use App\Enums\PaymentMechanism;
use App\Filament\Clusters\Finance\Resources\MembershipFees\MembershipFeeResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Pagos';

    protected static ?string $modelLabel = 'pago';

    protected static ?string $pluralModelLabel = 'pagos';

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                PdfViewerEntry::make('file')
                    ->hiddenLabel()
                    ->minHeight('80svh')
                    ->fileUrl(fn ($record) => route('admin.finance.incomes.pdf', ['income' => $record])),
            ])
            ->columns(1);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('concept')
                    ->label('Concepto')
                    ->default(fn () => $this->getOwnerRecord()->concept)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('amount')
                    ->label('Monto')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(function ($record) {
                        $membershipFee = $this->getOwnerRecord();

                        // Si estamos editando, agregamos el monto actual al pendiente
                        if ($record) {
                            return $membershipFee->pending_amount + $record->amount;
                        }

                        return $membershipFee->pending_amount > 0 ? $membershipFee->pending_amount : 1;
                    })
                    ->helperText(function ($record) {
                        $membershipFee = $this->getOwnerRecord();

                        // Si estamos editando, agregamos el monto actual al pendiente
                        $remaining = $record
                            ? $membershipFee->pending_amount + $record->amount
                            : $membershipFee->pending_amount;

                        return $remaining > 0
                            ? 'Restante por pagar: $'.number_format($remaining, 0, ',', '.')
                            : 'La cuota ya está completamente pagada';
                    })
                    ->prefix('$')
                    ->live(onBlur: true),
                ToggleButtons::make('mechanism')
                    ->label('Mecanismo de pago')
                    ->options(PaymentMechanism::class)
                    ->inline()
                    ->required(),
                DatePicker::make('date')
                    ->label('Fecha de pago')
                    ->default(now())
                    ->required(),
            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('concept')
            ->columns([
                TextColumn::make('concept')
                    ->label('Concepto')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Monto')
                    ->numeric(
                        decimalPlaces: 0,
                        decimalSeparator: ',',
                        thousandsSeparator: '.',
                    )
                    ->prefix('$')
                    ->sortable(),
                TextColumn::make('mechanism')
                    ->label('Mecanismo')
                    ->badge()
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Crear pago')
                    ->after(function () {
                        return redirect(MembershipFeeResource::getUrl('edit', [
                            'record' => $this->getOwnerRecord()->id,
                        ]));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
