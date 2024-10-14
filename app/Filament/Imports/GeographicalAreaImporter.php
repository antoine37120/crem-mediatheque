<?php

namespace App\Filament\Imports;

use App\Models\GeographicalArea;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Log;

class GeographicalAreaImporter extends Importer
{
    protected static ?string $model = GeographicalArea::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('region_code')
                ->example('af_australe')
                ->rules(['max:255']),
            ImportColumn::make('name')
                ->fillRecordUsing(function (GeographicalArea $record, string $state): void {
                    //$record->sku = strtoupper($state);
                    /*$locale = env('APP_LOCALE', false) ;
                    //$record->setTranslation('name', $locale, $state) ;
                    $record->translate('fr')->name = $state ;*/
                })
                ->example('Afrique australe')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?GeographicalArea
    {
        // return GeographicalArea::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new GeographicalArea();
    }

        
    protected function afterSave(): void
    {
        $this->record->name = $this->data['name'] ;
        $this->record->save() ;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your geographical area import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
