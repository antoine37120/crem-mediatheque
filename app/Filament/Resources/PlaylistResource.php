<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaylistResource\Pages;
use App\Filament\Resources\PlaylistResource\RelationManagers;
use App\Models\Playlist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;

class PlaylistResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = Playlist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()->columnSpan(2)
                ->localeTabSchema(fn (TranslatableTab $tab) => [
                    Forms\Components\TextInput::make($tab->makeName('name'))
                        // required only for the main locale
                        ->required($tab->isMainLocale())
                        ->maxLength(255)
                        // generate slug for the item based on the main locale
                        /*->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) use ($tab) {
                            if ($tab->isMainLocale()) {
                                $set('slug', Str::slug($state));
                            }
                        }),*/,
                    Forms\Components\RichEditor::make($tab->makeName('description'))
                    // required only for the main locale
                    ->columnSpanFull()
                    // generate slug for the item based on the main locale
                    /*->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) use ($tab) {
                        if ($tab->isMainLocale()) {
                            $set('slug', Str::slug($state));
                        }
                    }),*/
                ]),
                Forms\Components\Select::make('type_id')
                    ->default(1)
                    ->required()
                    ->relationship(name: 'type', titleAttribute: 'name'),
                Forms\Components\FileUpload::make('picture')
                    ->disk('public')
                    ->preserveFilenames()
                    ->directory('playlists-pictures')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translations.name')->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
                Tables\Columns\TextColumn::make('translation.name')->label('Name'),
                Tables\Columns\TextColumn::make('picture')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AudioItemPlaylistsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaylists::route('/'),
            'create' => Pages\CreatePlaylist::route('/create'),
            'edit' => Pages\EditPlaylist::route('/{record}/edit'),
        ];
    }

    
    public static function getGloballySearchableAttributes(): array
    {
        return ['translation.name', 'translation.description'];
    }

    
    public static function getGlobalSearchResultTitle(\Illuminate\Database\Eloquent\Model $record): \Illuminate\Contracts\Support\Htmlable | string
    {
        return $record->name;
    }
}
