<?php

namespace App\Filament\Imports;

use App\Models\GeographicalArea;
use App\Models\AudioItem;
use App\Models\AudioItemTranslation;
use App\Models\AudioItemPlaylist;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Notifications\Notification;
use wapmorgan\Mp3Info\Mp3Info;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BrowsershotController;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\CarbonInterface;

class AudioItemImporter extends Importer
{
    protected static ?string $model = AudioItem::class;

    public ?string $mp3FileToMove = null;

    public ?string $mp3Error = null;

    public array $filesToDelete = [];

    public static function getOptionsFormComponents(): array
    {
        return [
            \Filament\Forms\Components\Toggle::make('create_missing_areas')
                ->label('Creer automatiquement les aires geographiques manquantes')
                ->helperText('Si active, les aires geographiques du CSV qui n\'existent pas seront creees automatiquement avec le code comme nom francais.')
                ->default(false),
        ];
    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('original_name')
                ->guess(['original_name','TITRE ORIGINAL'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    if (!empty($state) || !$record->exists) {
                        $record->original_name = $state;
                    }
                })
                ->example('Nom original archive')
                ->rules(['max:255']),
            ImportColumn::make('name')
                ->guess(['name','TITRE ALTERNATIF'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    // set it after save
                })
                ->example('Un nom en français')
                ->rules(['max:255']),
            ImportColumn::make('name_en')
                ->guess(['name_en','TITRE ANGLAIS'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    // set it after save
                })
                ->example('Name in english')
                ->rules(['max:255']),
            ImportColumn::make('description')
                ->guess(['description','DESCRIPTION'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    // set it after save
                })
                ->example('Une description'),
            ImportColumn::make('description_en')
                ->guess(['description_en','DESCRIPTION ANGLAIS'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    // set it after save
                })
                ->example('Description in english') ,
            ImportColumn::make('year')
                ->guess(['year','ANNÉE D\'ENREGISTREMENT'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    if (!empty($state) || !$record->exists) {
                        $record->year = $state;
                    }
                })
                ->example(1953)
                ->requiredMapping(),
            ImportColumn::make('geographicalArea')
                ->guess(['geographicalArea','AIRE GEO', 'geographical_area'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    // Resolution manuelle dans beforeSave
                })
                ->example('af_occidentale')
                ->rules(['nullable']),
            ImportColumn::make('interpreters')
                ->guess(['interpreters','INTERPRETE'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    if (!empty($state) || !$record->exists) {
                        $record->interpreters = $state;
                    }
                })
                ->example('Nurlanbek Nishanov'),
            ImportColumn::make('collector')
                ->guess(['collector','COLLECTEUR'])
                ->fillRecordUsing(function (AudioItem $record, string|null $state): void {
                    if (!empty($state) || !$record->exists) {
                        $record->collector = $state;
                    }
                })
                ->example('During, Jean')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('link')
                ->guess(['link','LIEN'])
                ->example('https://archives.crem-cnrs.fr/archives/items/CNRSMH_I_2020_023_001_34/')
                ->requiredMapping()
                ->rules(['max:255']),
        ];

        // Colonnes du CSV ignorees (non presentes dans le modele AudioItem) :
        // 'pays', 'remarque', 'autorisation pour items en acces restreint'
    }

    public function getValidationMessages(): array
    {
        return [
            'collector.required' => 'Le champ "collector" (collecteur) est obligatoire. Verifiez que chaque ligne du CSV a un collecteur renseigne.',
            'collector.max' => 'Le nom du collecteur ne doit pas depasser 255 caracteres.',
            'original_name.max' => 'Le nom original ne doit pas depasser 255 caracteres.',
            'name.max' => 'Le titre alternatif ne doit pas depasser 255 caracteres.',
            'name_en.max' => 'Le titre anglais ne doit pas depasser 255 caracteres.',
            'link.max' => 'Le lien ne doit pas depasser 255 caracteres.',
        ];
    }

    public function getValidationAttributes(): array
    {
        return [
            'original_name' => 'nom original',
            'name' => 'titre alternatif',
            'name_en' => 'titre anglais',
            'description' => 'description',
            'description_en' => 'description anglaise',
            'year' => 'annee',
            'geographicalArea' => 'aire geographique',
            'interpreters' => 'interpretes',
            'collector' => 'collecteur',
            'link' => 'lien',
        ];
    }

    public function resolveRecord(): ?AudioItem
    {
        // return AudioItem::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        $AudioItem = AudioItem::firstOrNew([
            'link' => $this->data['link'],
        ]);


        return $AudioItem;




        //return new AudioItem();
    }


    protected function beforeSave(): void
    {
        // Resolution manuelle de l'aire geographique
        if (!empty($this->data['geographicalArea'])) {
            $geoArea = GeographicalArea::where('region_code', $this->data['geographicalArea'])->first();
            if ($geoArea) {
                $this->record->geographical_area_id = $geoArea->id;
            } elseif (!empty($this->options['create_missing_areas'])) {
                // Creer l'aire geographique automatiquement
                $geoArea = new GeographicalArea();
                $geoArea->region_code = $this->data['geographicalArea'];
                $geoArea->save();
                // Creer la traduction FR avec le region_code comme nom
                $geoArea->translateOrNew('fr')->name = $this->data['geographicalArea'];
                $geoArea->save();
                $this->record->geographical_area_id = $geoArea->id;
                Log::info("Aire geographique creee automatiquement : {$this->data['geographicalArea']} (id: {$geoArea->id})");
            } else {
                $availableCodes = GeographicalArea::pluck('region_code')->implode(', ');
                throw new RowImportFailedException(
                    "Aire geographique inconnue : \"{$this->data['geographicalArea']}\". "
                    . "Les codes valides sont : {$availableCodes}. "
                    . "Cochez l'option \"Creer les aires manquantes\" pour les creer automatiquement."
                );
            }
        }

        $this->mp3FileToMove = null;
        $this->mp3Error = null;

        // Ne pas chercher de fichier si le lien est vide (pas de cote exploitable)
        if (empty($this->record->link)) {
            $this->mp3Error = "Pas de lien renseigne, impossible de rechercher le fichier audio associe.";
            $this->record->cote = null;
            $this->record->file = null;
            $this->record->duration = 0;
            $this->record->picture = null;
            return;
        }

        $link_eploded = explode('/', rtrim($this->record->link, "/")) ;
        $size = sizeof($link_eploded) ;
        $cote = $link_eploded[$size - 1]  ;

        $storagePath = storage_path("app/public/import");
        $files = File::glob("$storagePath/*".$cote."*.mp3");

        // Si l'item existe deja avec un fichier, ne pas ecraser par null
        $isUpdate = $this->record->exists;

        if(sizeof($files) == 1) {
            $this->mp3FileToMove = $files[0];
            $fileName = basename($this->mp3FileToMove);
            $newFileName = Str::ascii($fileName);
            $path = 'audio-item-sound/'.$newFileName;
            $this->record->file = $path;

            // duration (simulation du chemin pour Mp3Info)
            $sys_path = $this->mp3FileToMove;
            $audio = new Mp3Info($sys_path);
            $this->record->duration = $audio->duration;

            // Generate picture and other related data if file changed
            // We can't call generatePicture() here because record is not yet saved
            // but we can set up for afterSave
        } elseif (sizeof($files) == 0) {
            if ($isUpdate && !empty($this->record->getOriginal('file'))) {
                // Item existant avec fichier : garder le fichier actuel et ses donnees liees
                $this->mp3Error = null; // Pas d'erreur, c'est normal
                // S'assurer que duration et file ne sont pas touches s'ils ont ete modifies par accident
                $this->record->file = $this->record->getOriginal('file');
                $this->record->duration = $this->record->getOriginal('duration');
                $this->record->picture = $this->record->getOriginal('picture');
            } else {
                // Nouvel item sans fichier
                $this->mp3Error = "Aucun fichier MP3 trouve dans le dossier import pour la cote {$cote}. Fichiers recherches : *{$cote}*.mp3";
                $this->record->file = null;
                $this->record->duration = 0;
                $this->record->picture = null;
            }
        } else {
            if ($isUpdate && !empty($this->record->getOriginal('file'))) {
                // Plusieurs fichiers trouves mais on a deja un fichier : on garde l'existant avec un warning
                $this->mp3Error = "Plusieurs fichiers MP3 trouves pour la cote {$cote} : " . implode(', ', array_map('basename', $files)) . ". Le fichier existant est conserve.";
                Log::warning($this->mp3Error);
                $this->record->file = $this->record->getOriginal('file');
                $this->record->duration = $this->record->getOriginal('duration');
                $this->record->picture = $this->record->getOriginal('picture');
            } else {
                $this->mp3Error = "Plusieurs fichiers MP3 trouves pour la cote {$cote} : " . implode(', ', array_map('basename', $files)) . ". Veuillez n'en garder qu'un.";
                $this->record->file = null;
                $this->record->duration = 0;
                $this->record->picture = null;
            }
        }

        $this->record->cote = $cote;
    }

    protected function afterSave(): void
    {
        // 1. Sauvegarder playlist_id sur l'import (non critique)
        try {
            if ($this->import->playlist_id === null && isset($this->options['playlistId'])) {
                $this->import->playlist_id = $this->options['playlistId'];
                $this->import->save();
            }
        } catch (\Throwable $e) {
            Log::warning("Impossible de sauvegarder playlist_id sur l'import : " . $e->getMessage());
        }

        // 2. Traduction FR (critique)
        try {
            $AudioItemTranslation = AudioItemTranslation::firstOrNew([
                'audio_item_id' => $this->record->id,
                'locale' => 'fr',
            ]);
            $AudioItemTranslation->audio_item_id = $this->record->id;
            $AudioItemTranslation->locale = 'fr';
            // Ne pas ecraser par une valeur vide si la traduction existe deja
            if (!empty($this->data['name']) || !$AudioItemTranslation->exists) {
                $AudioItemTranslation->name = $this->data['name'];
            }
            if (!empty($this->data['description']) || !$AudioItemTranslation->exists) {
                $AudioItemTranslation->description = $this->data['description'];
            }
            $AudioItemTranslation->save();
        } catch (\Throwable $e) {
            Log::error("Erreur traduction FR pour item {$this->record->id} : " . $e->getMessage());
            throw new RowImportFailedException("Erreur lors de la sauvegarde de la traduction francaise : " . $e->getMessage());
        }

        // 3. Traduction EN (non critique : ne pas faire echouer l'item si la trad EN echoue)
        try {
            $AudioItemTranslationEn = AudioItemTranslation::firstOrNew([
                'audio_item_id' => $this->record->id,
                'locale' => 'en',
            ]);
            $AudioItemTranslationEn->audio_item_id = $this->record->id;
            $AudioItemTranslationEn->locale = 'en';
            if (!empty($this->data['name_en']) || !$AudioItemTranslationEn->exists) {
                $AudioItemTranslationEn->name = $this->data['name_en'];
            }
            if (!empty($this->data['description_en']) || !$AudioItemTranslationEn->exists) {
                $AudioItemTranslationEn->description = $this->data['description_en'];
            }
            $AudioItemTranslationEn->save();
        } catch (\Throwable $e) {
            Log::warning("Erreur traduction EN pour item {$this->record->id} (non bloquant) : " . $e->getMessage());
        }

        // 4. Relation playlist (critique)
        try {
            $AudioItemPlaylist = AudioItemPlaylist::firstOrNew([
                'audio_item_id' => $this->record->id,
                'playlist_id' => $this->options['playlistId'],
            ]);

            if (!$AudioItemPlaylist->exists) {
                $maxSort = AudioItemPlaylist::where('playlist_id', $this->options['playlistId'])
                    ->max('sort') ?? 0;
                $AudioItemPlaylist->sort = $maxSort + 1;
            }

            $AudioItemPlaylist->save();
        } catch (\Throwable $e) {
            Log::error("Erreur relation playlist pour item {$this->record->id} : " . $e->getMessage());
            throw new RowImportFailedException("Erreur lors de l'association a la playlist : " . $e->getMessage());
        }

        // 5. Copie du fichier MP3 (critique) + enregistrement pour suppression en fin d'import
        if ($this->mp3FileToMove) {
            $source = 'import/' . basename($this->mp3FileToMove);
            $dest = 'audio-item-sound/' . Str::ascii(basename($this->mp3FileToMove));
            try {
                Storage::copy($source, $dest);
            } catch (\Throwable $e) {
                Log::error("Erreur copie MP3 pour item {$this->record->id} : " . $e->getMessage());
                throw new RowImportFailedException("Erreur lors de la copie du fichier MP3 : " . $e->getMessage());
            }
            $this->filesToDelete[] = $source;
        }

        // 6. Generation waveform (NON critique : ne jamais faire echouer l'item)
        if ($this->mp3FileToMove) {
            try {
                $this->record->generatePicture();
            } catch (\Throwable $e) {
                Log::error("Erreur generation waveform pour item {$this->record->id} (non bloquant) : " . $e->getMessage());
            }
        }

        // 7. Log des warnings MP3 (non critique)
        if ($this->mp3Error) {
            Log::warning($this->mp3Error);

            try {
                $name = $this->data['original_name'] ?? $this->data['name'] ?? "Item #{$this->record->id}";
                \App\Models\ImportWarning::create([
                    'import_id' => $this->import->id,
                    'message' => "{$name} : {$this->mp3Error}",
                ]);
            } catch (\Throwable $e) {
                Log::warning("Impossible d'enregistrer le warning d'import : " . $e->getMessage());
            }

            Notification::make()
                ->title('Item importe sans fichier audio')
                ->body($this->mp3Error)
                ->warning()
                ->send();
        }
    }

    public function getJobRetryUntil(): ?CarbonInterface
    {
        return null;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import termine : ' . number_format($import->successful_rows) . '/' . number_format($import->total_rows) . ' items importes.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= "\n" . number_format($failedRowsCount) . ' items en echec :';
            $failedRows = $import->failedRows()->limit(5)->get();

            foreach ($failedRows as $failedRow) {
                $name = $failedRow->data['original_name'] ?? $failedRow->data['name'] ?? 'Inconnu';
                $error = $failedRow->validation_error ?? 'Erreur inconnue';
                $body .= "\n- \"{$name}\" : {$error}";
            }

            if ($failedRowsCount > 5) {
                $body .= "\net " . ($failedRowsCount - 5) . " autres...";
            }
        }

        if (isset($import->options['playlistId'])) {
            $playlistUrl = route('filament.crem-admin.resources.playlists.edit', $import->options['playlistId']);
            $body .= "\n\nVoir la playlist : " . $playlistUrl;
        }

        if ($failedRowsCount ?? 0) {
            $downloadUrl = route('crem-admin.imports.failed-rows.download', ['import' => $import], absolute: false);
            $body .= "\nTelecharger le CSV des erreurs : " . url($downloadUrl);
        }

        $warnings = \App\Models\ImportWarning::where('import_id', $import->id)->get();
        if ($warnings->isNotEmpty()) {
            $body .= "\n\nAvertissements :";
            foreach ($warnings->take(10) as $warning) {
                $body .= "\n- {$warning->message}";
            }
            if ($warnings->count() > 10) {
                $body .= "\net " . ($warnings->count() - 10) . " autres...";
            }
        }

        return (string) Str::limit($body, 2000);
    }
}
