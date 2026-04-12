<?php

namespace App\Filament\Resources\PlaylistResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Log;
use App\Models\AudioItem;
use App\Filament\Imports\AudioItemImporter;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Support\Collection;
use App\Filament\Resources\AudioItemResource;
use Filament\Actions\EditAction;
use Livewire\Component;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use Illuminate\Support\Str;
use Filament\Forms\Set;
class AudioItemPlaylistsRelationManager extends RelationManager
{
    //use ResourceTranslatable;
    protected static string $relationship = 'audio_item_playlists';


    public function form(Form $form): Form
    {
        if ($form->getOperation() == 'edit') {
            //$form->model = $form->model->audio_item()->first() ;
            //ds($form);
            //return AudioItemResource::form($form);
            return $this->getAudioItemEditForm($form);

        }

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
                    ->wrap()
                ->sortable(),
                Tables\Columns\TextColumn::make('audio_item.name')->label('Name')
                    ->wrap()
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable(),
                Tables\Columns\TextColumn::make('sort')
                ->sortable(),

                Tables\Columns\ToggleColumn::make('audio_item.published')
                ->label('Published'),
            ])
            ->defaultSort('sort')
            ->defaultPaginationPageOption(25)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('Ajouter un item audio')
                ->mutateFormDataUsing(function (array $data): array {
                    Log::info(print_r($data, true));

                    return $data;
                }),
                ImportAction::make()
                ->importer(AudioItemImporter::class)
                ->job(\App\Jobs\ImportCsv::class)
                ->label('Importer des items audio')
				->chunkSize(5)
                ->options(['playlistId' => $this->getOwnerRecord()->getKey()])
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    //->form(fn (Form $form) => $this->getAudioItemEditForm($form))
                    ->mutateRecordDataUsing(function (array $data, $record): array {
                        // Charger l'audio_item avec ses traductions
                        $audioItem = $record->audio_item;
                        $audioItem->load('translations');

                        // Convertir en tableau
                        $formData = $audioItem->toArray();

                        // Ajouter les traductions dans le format attendu par TranslatableTabs
                        foreach ($audioItem->translations as $translation) {
                            $formData[$translation->locale] = [
                                'name' => $translation->name,
                                'description' => $translation->description,
                            ];
                        }

                        return $formData;
                    })
                    ->using(function ($record, array $data): \Illuminate\Database\Eloquent\Model {
                        // Sauvegarder les modifications sur l'audio_item
                        $audioItem = $record->audio_item;

                        // Extraire les traductions du tableau $data
                        $translations = [];
                        $mainData = [];

                        foreach ($data as $key => $value) {
                            // Vérifier si c'est une clé de locale (fr, en, etc.)
                            if (in_array($key, config('translatable.locales', ['fr', 'en']))) {
                                $translations[$key] = $value;
                            } else {
                                $mainData[$key] = $value;
                            }
                        }

                        // Mettre à jour les champs non traduits
                        $audioItem->update($mainData);

                        // Mettre à jour les traductions
                        foreach ($translations as $locale => $fields) {
                            foreach ($fields as $field => $value) {
                                $audioItem->translateOrNew($locale)->$field = $value;
                            }
                        }

                        $audioItem->save();

                        return $record;
                    }),
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

    /**
     * Formulaire complet pour éditer un AudioItem via la relation
     */
    private function getAudioItemEditForm(Form $form): Form
    {
        $conf_colors = config('custom.items_colors');

        return $form
            ->schema([
                Actions::make([
                    Action::make('make_picture')->label('Generate picture')
                        ->action(function (Set $set, $state) {
                            $record = AudioItem::find($state['id']) ;
                            $hasFile = false;
                            foreach ($state['file'] as $file) {
                                $record->file = $file ;
                                $hasFile = true;
                            }
                            if($hasFile) {
                                $keyPicture = Str::uuid()->toString();
                                $record->generatePicture();
                                $set('picture', [$keyPicture => $record->picture]);
                            }
                        }),
                    Action::make('calc_duration')->label('Define duration')
                        ->action(function (Set $set, $state) {
                            $record = AudioItem::find($state['id']) ;
                            $hasFile = false;
                            foreach ($state['file'] as $file) {
                                $record->file = $file ;
                                $hasFile = true;
                            }
                            if($hasFile) {
                                $record->calculateDuration();
                                $set('duration', $record->duration);
                            }
                        }),
                ]),
                \CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs::make()->columnSpan(2)
                    ->localeTabSchema(fn (\CactusGalaxy\FilamentAstrotomic\TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('name'))
                            ->required($tab->isMainLocale())
                            ->maxLength(255),
                        Forms\Components\RichEditor::make($tab->makeName('description'))
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Toggle::make('published')
                    ->inline(false),
                Forms\Components\TextInput::make('cote')
                    ->required(),
                Forms\Components\TextInput::make('original_name'),
                Forms\Components\TextInput::make('link'),
                Forms\Components\TextInput::make('duration')
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->numeric(),
                Forms\Components\Select::make('geographical_area_id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->options(
                        \App\Models\GeographicalArea::listsTranslations('name')->get()->pluck('name', 'id')
                    ),
                Forms\Components\FileUpload::make('file')
                    ->directory('audio-item-sound')
                    ->preserveFilenames(),
                Forms\Components\Textarea::make('interpreters'),
                Forms\Components\TextInput::make('collector')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('picture')
                    ->disk('public')
                    ->preserveFilenames()
                    ->directory('audio-item-image'),
                \Awcodes\Palette\Forms\Components\ColorPicker::make('color')
                    ->colors($conf_colors)
                    ->storeAsKey(),
            ]);
    }
}
