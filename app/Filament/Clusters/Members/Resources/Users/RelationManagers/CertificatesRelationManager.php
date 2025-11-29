<?php

namespace App\Filament\Clusters\Members\Resources\Users\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class CertificatesRelationManager extends RelationManager
{
    protected static string $relationship = 'certificates';

    protected static ?string $modelLabel = 'certificado';

    protected static ?string $pluralModelLabel = 'certificados';

    protected static ?string $title = 'Certificados';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('institution')
                    ->label('Institución')
                    ->default(null),
                DatePicker::make('issued_date')
                    ->label('Fecha de emisión')
                    ->required()
                    ->default(now()),
                Select::make('certificate_type_id')
                    ->label('Tipo de certificado')
                    ->relationship('certificateType', 'name')
                    ->required(),
                Select::make('signer_id_1')
                    ->label('Firmante')
                    ->searchable()
                    ->relationship('signer1', 'name'),
                Select::make('signer_id_2')
                    ->label('Firmante')
                    ->searchable()
                    ->relationship('signer2', 'name'),
                Select::make('signer_id_3')
                    ->label('Firmante (obligatorio)')
                    ->searchable()
                    ->relationship('signer3', 'name')
                    ->default(auth()->id())
                    ->required(),
                DateTimePicker::make('citation_start')
                    ->label('Inicio de citación'),
                DateTimePicker::make('citation_end')
                    ->label('Fin de citación'),

                // TextInput::make('pdf_path')
                //     ->label('Ruta del PDF')
                //     ->default(null),
            ])
            ->columns(3);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                PdfViewerEntry::make('file')
                    ->hiddenLabel()
                    ->minHeight('80svh')
                    ->fileUrl(fn ($record) => route('admin.members.certificates.pdf', ['certificate' => $record])),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('institution')
            ->columns([
                TextColumn::make('issued_date')
                    ->label('Fecha de emisión')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('certificateType.name')
                    ->label('Tipo de certificado')
                    ->searchable(),
                TextColumn::make('institution')
                    ->label('Institución')
                    ->searchable(),
                TextColumn::make('citation_start')
                    ->label('Inicio de citación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('citation_end')
                    ->label('Fin de citación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('signer1.name')
                    ->label('Firmante 1')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('signer2.name')
                    ->label('Firmante 2')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('signer3.name')
                    ->label('Firmante 3')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('pdf_path')
                //     ->label('Ruta del PDF')
                //     ->searchable(),
                TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado en')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Eliminado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make(),
                // AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                // DissociateAction::make(),
                DeleteAction::make(),
                // ForceDeleteAction::make(),
                // RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                    // ForceDeleteBulkAction::make(),
                    // RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
