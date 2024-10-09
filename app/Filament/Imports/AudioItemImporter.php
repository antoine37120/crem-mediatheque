<?php

namespace App\Filament\Imports;

use App\Models\AudioItem;
use App\Models\AudioItemTranslation;
use App\Models\AudioItemPlaylist;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use wapmorgan\Mp3Info\Mp3Info;

class AudioItemImporter extends Importer
{
    protected static ?string $model = AudioItem::class;

    public $order = 1 ;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('original_name')
                ->guess(['original_name','TITRE ORIGINAL'])
                ->example('Nom original archive')
                ->rules(['max:255']),
            ImportColumn::make('name')
                ->guess(['name','TITRE ALTERNATIF'])
                ->fillRecordUsing(function (AudioItem $record, string $state): void {
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
                ->example(1953)
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('geographicalArea')
                ->guess(['geographicalArea','AIRE GEO'])
                ->example('af_occidentale')
                ->relationship(resolveUsing: 'region_code'),
            ImportColumn::make('interpreters')
                ->guess(['interpreters','INTERPRETE'])
                ->example('Nurlanbek Nishanov'),
            ImportColumn::make('collector')
                ->guess(['collector','COLLECTEUR'])
                ->example('During, Jean')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('link')
                ->guess(['link','LIEN'])
                ->example('https://archives.crem-cnrs.fr/archives/items/CNRSMH_I_2020_023_001_34/')
                ->rules(['max:255']),
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
        //get file infos 
        // To get basic audio information
        /*$audio = new Mp3Info('./audio.mp3');
        echo 'Audio duration: '.floor($audio->duration / 60).' min '.floor($audio->duration % 60).' sec'.PHP_EOL;
        $this->record->duration = $audio->duration
        */
        $this->record->file = 'filePath------' ;
        $this->record->cote = 'CNRSMH_I_1970_019_067_02' ;
        $this->record->duration = 100 ;
        // Runs before the CSV data for a row is validated.
    }

    protected function afterSave(): void
    {
        
        /*$this->record->setTranslation('name', 'fr', $this->data['name']);
        $this->record->setTranslation('name', 'fr', 'hhhhhhhhhhhhhh');
        $this->record->setTranslation('name', 'en', $this->data['name_en']);

        $translations = ['en' => $this->data['name_en'] , 'fr' => $this->data['name']];
        $audioItem = AudioItem::find($this->record->id) ;
        $audioItem->name = $translations;
        $audioItem->save() ;

        $this->record->setTranslation('description', 'fr', $this->data['description']);
        $this->record->setTranslation('description', 'en', $this->data['description_en']);
        $this->record->save() ;*/

        
        $AudioItemTranslation = AudioItemTranslation::firstOrNew([ 'audio_item_id' => $this->record->id, 'locale' => 'fr', ]);
        $AudioItemTranslation->audio_item_id = $this->record->id;
        $AudioItemTranslation->locale = 'fr';
        $AudioItemTranslation->name = $this->data['name'];
        $AudioItemTranslation->description = $this->data['description'];
        $AudioItemTranslation->save() ;

        $AudioItemTranslationEn = AudioItemTranslation::firstOrNew([ 'audio_item_id' => $this->record->id, 'locale' => 'en', ]);
        $AudioItemTranslationEn->audio_item_id = $this->record->id;
        $AudioItemTranslationEn->locale = 'en';
        $AudioItemTranslationEn->name = $this->data['name_en'];
        $AudioItemTranslationEn->description = $this->data['description_en'];
        $AudioItemTranslationEn->save() ;


        //$this->record->playlists()->syncWithoutDetaching([$this->options['playlistId']]);
        $AudioItemPlaylist = AudioItemPlaylist::firstOrNew([
                 // Update existing records, matching them by `$this->data['column_name']`
                'sort' => $this->order,
                'audio_item_id' => $this->record->id,
                'playlist_id' => $this->options['playlistId'],
        ]);
        $AudioItemPlaylist->save() ;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your audio item import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
