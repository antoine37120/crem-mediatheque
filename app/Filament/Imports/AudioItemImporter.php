<?php

namespace App\Filament\Imports;

use App\Models\AudioItem;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use wapmorgan\Mp3Info\Mp3Info;

class AudioItemImporter extends Importer
{
    protected static ?string $model = AudioItem::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('duration')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('year')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('geographicalArea')
                ->relationship(),
            ImportColumn::make('file')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('interpreters'),
            ImportColumn::make('collector')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('picture')
                ->rules(['max:255']),
            ImportColumn::make('cote')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?AudioItem
    {
        // return AudioItem::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new AudioItem();
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
