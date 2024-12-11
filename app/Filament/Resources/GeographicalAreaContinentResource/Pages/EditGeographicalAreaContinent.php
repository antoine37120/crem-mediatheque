<?php

namespace App\Filament\Resources\GeographicalAreaContinentResource\Pages;

use App\Filament\Resources\GeographicalAreaContinentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditGeographicalAreaContinent extends EditRecord
{
    use EditTranslatable;
    
    protected static string $resource = GeographicalAreaContinentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
