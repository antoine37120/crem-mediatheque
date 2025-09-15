<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AudioItemResource\Pages;
use App\Filament\Resources\AudioItemResource\RelationManagers;
use App\Models\AudioItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Tables\Filters\SelectFilter;
use App\Models\GeographicalArea;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Collection;
use Awcodes\Palette\Forms\Components\ColorPicker;

class AudioItemResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = AudioItem::class;

    protected static ?string $navigationLabel = 'Items audio';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    //protected static ?string $recordTitleAttribute = 'translation.name';

    public static function form(Form $form): Form
    {
        $conf_colors = config('custom.items_colors');
        /*$options_colors = [];
        foreach($conf_colors as $key => $color ) {
            $options_colors[$color] = $color ;
        }*/

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
                Toggle::make('published')
                ->inline(false),
                Forms\Components\TextInput::make('cote')
                    ->required(),
                Forms\Components\TextInput::make('original_name'),
                Forms\Components\TextInput::make('link'),
                Forms\Components\TextInput::make('duration')
                    //->required()
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->numeric(),
                Forms\Components\Select::make('geographical_area_id')
                ->required()
                ->native(false)
                ->searchable()
                ->options(
                    GeographicalArea::listsTranslations('name')->get()->pluck('name', 'id')
                ),
                Forms\Components\FileUpload::make('file')
                    ->directory('audio-item-image')
                    ->preserveFilenames(),
                Forms\Components\Textarea::make('interpreters'),
                    //->columnSpanFull(),
                Forms\Components\TextInput::make('collector')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('picture')
                ->disk('public')
                ->preserveFilenames()
                ->directory('audio-item-image'),
                //->required(),
                /*Forms\Components\Select::make('color')
                ->options($options_colors)
                ->native(false)
                ->allowHtml(),*/

                ColorPicker::make('color')
                ->colors($conf_colors)
                ->storeAsKey(),
            ]);
    }

    public static function table(Table $table): Table
    {


        return $table
            ->columns([
                Tables\Columns\ColorColumn::make('color')
                ->state(function (AudioItem $record): string {
                    $conf_colors = config('custom.items_colors');
                    if($record->color != null){
                        $record->getHexaColor();
                        $record->save() ;
                        return $conf_colors[$record->color] ;
                    } else {

                        $record->getHexaColor();
                        $record->save() ;
                        return $conf_colors[$record->color] ;
                    }

                }),
                Tables\Columns\ImageColumn::make('picture')->label('Wave')
                //->disk('public')
                ->extraImgAttributes(['style' => 'background:black;'])
                /*->width(50)*/,
                Tables\Columns\TextColumn::make('cote')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('translations.name')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
                Tables\Columns\TextColumn::make('original_name')->label('Original Name'),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('geographicalArea.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('collector')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                ToggleColumn::make('published'),
                /*Tables\Columns\TextColumn::make('picture')
                    ->searchable(),*/
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
                SelectFilter::make('geographical_area_id')
                ->label('Zone géographique')
                ->options(
                    GeographicalArea::listsTranslations('name')->get()->pluck('name', 'id')
                ),
                SelectFilter::make('published')
                ->options([
                    '0' => 'Reviewing',
                    '1' => 'Published',
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('publish')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->published = true;
                            $record->save();
                        }
                    }),
                    Tables\Actions\BulkAction::make('unpublish')
                    ->requiresConfirmation()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->published = false;
                            $record->save();
                        }
                    }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PlaylistsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAudioItems::route('/'),
            'create' => Pages\CreateAudioItem::route('/create'),
            'edit' => Pages\EditAudioItem::route('/{record}/edit'),
        ];
    }



    public static function getGloballySearchableAttributes(): array
    {
        return ['translations.name', 'translations.description'];
    }

    public static function getGlobalSearchResultTitle(\Illuminate\Database\Eloquent\Model $record): \Illuminate\Contracts\Support\Htmlable | string
    {
        return $record->name;
    }
}
