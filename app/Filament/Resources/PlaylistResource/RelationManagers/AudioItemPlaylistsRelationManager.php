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

class AudioItemPlaylistsRelationManager extends RelationManager
{
    protected static string $relationship = 'audio_item_playlists';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('audio_item_id')
                    ->relationship(name: 'audio_item', titleAttribute: 'name')
                    ->searchable(['name'])
                    ->preload()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->reorderable('sort')
            ->columns([
                Tables\Columns\TextColumn::make('audio_item.name')
                ->sortable(),
                Tables\Columns\TextColumn::make('sort')
                ->sortable(),
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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
