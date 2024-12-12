<?php

namespace App\Filament\Resources\PlaylistResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Log;
use App\Models\AudioItem;
use App\Filament\Imports\AudioItemImporter;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Support\Collection;

class AudioItemPlaylistsRelationManager extends RelationManager
{
    protected static string $relationship = 'audio_item_playlists';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('audio_item_id')
                    ->options(
                        AudioItem::listsTranslations('name')->get()->pluck('name', 'id')
                    )
                    ->searchable(['name'])
                    ->preload()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->recordTitleAttribute('name')
            ->reorderable('sort')
            ->columns([
                Tables\Columns\TextColumn::make('audio_item.cote')->label('Cote')
                ->sortable(),
                Tables\Columns\TextColumn::make('audio_item.original_name')->label('Original name')
                ->sortable(),
                Tables\Columns\TextColumn::make('audio_item.name')->label('Name')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable(),
                Tables\Columns\TextColumn::make('sort')
                ->sortable(),
                
                Tables\Columns\ToggleColumn::make('audio_item.published'),
            ])
            ->defaultSort('sort')
            ->defaultPaginationPageOption(25)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    Log::info(print_r($data, true));
             
                    return $data;
                }),
                ImportAction::make()
                ->importer(AudioItemImporter::class)
				->chunkSize(5)
                ->options(['playlistId' => $this->getOwnerRecord()->getKey()])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('publish')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->audio_item->published = true;
                            $record->audio_item->save();
                        }
                    }),
                    Tables\Actions\BulkAction::make('unpublish')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->audio_item->published = false;
                            $record->audio_item->save();
                        }
                    }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
