<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImportResource\Pages;
use App\Filament\Resources\ImportResource\RelationManagers;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Imports\AudioItemImporter;
use Illuminate\Support\HtmlString;

class ImportResource extends Resource
{
    protected static ?string $model = Import::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationLabel = 'Historique des imports';

    protected static ?string $pluralLabel = 'Historique des imports';

    protected static ?string $modelLabel = 'Import';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                TextColumn::make('file_name')
                    ->label('Fichier')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('importer')
                    ->label('Type d\'import')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        AudioItemImporter::class => 'Audio Items',
                        default => str($state)->afterLast('\\')->headline(),
                    })
                    ->sortable(),
                TextColumn::make('successful_rows')
                    ->label('Succès / Total')
                    ->formatStateUsing(fn ($record): string => "{$record->successful_rows} / {$record->total_rows}")
                    ->badge()
                    ->color(fn ($record): string => match (true) {
                        $record->successful_rows === $record->total_rows => 'success',
                        $record->successful_rows > 0 => 'warning',
                        default => 'danger',
                    }),
                TextColumn::make('completed_at')
                    ->label('Terminé le')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('importer')
                    ->label('Type d\'import')
                    ->options([
                        AudioItemImporter::class => 'Audio Items',
                    ])
                    ->default(AudioItemImporter::class),
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'success' => 'Succès complet',
                        'partial' => 'Partiel',
                        'failed' => 'En échec',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value']) {
                            'success' => $query->whereColumn('successful_rows', 'total_rows'),
                            'partial' => $query->where('successful_rows', '>', 0)->whereColumn('successful_rows', '<', 'total_rows'),
                            'failed' => $query->where('successful_rows', 0)->where('total_rows', '>', 0),
                            default => $query,
                        };
                    }),
            ])
            ->actions([
                Action::make('view_errors')
                    ->label('Voir les erreurs')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->color('danger')
                    ->slideOver()
                    ->modalHeading('Erreurs d\'importation')
                    ->modalSubmitAction(false)
                    ->visible(fn (Import $record): bool => $record->failedRows()->exists())
                    ->modalContent(fn (Import $record) => view('filament.resources.import.errors', ['import' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageImports::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
