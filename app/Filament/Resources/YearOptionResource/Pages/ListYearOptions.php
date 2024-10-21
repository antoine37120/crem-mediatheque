<?php

namespace App\Filament\Resources\YearOptionResource\Pages;

use App\Filament\Resources\YearOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;

class ListYearOptions extends ListRecords
{
    use ListTranslatable;
    protected static string $resource = YearOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
