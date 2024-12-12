<?php

namespace App\Filament\Resources\GeographicalAreaContinentResource\Pages;

use App\Filament\Resources\GeographicalAreaContinentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreateGeographicalAreaContinent extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = GeographicalAreaContinentResource::class;
}
