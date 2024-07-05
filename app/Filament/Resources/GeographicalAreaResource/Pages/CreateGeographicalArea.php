<?php

namespace App\Filament\Resources\GeographicalAreaResource\Pages;

use App\Filament\Resources\GeographicalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreateGeographicalArea extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = GeographicalAreaResource::class;
 
    protected function getHeaderActions(): array
    {
        return [
            // ...
        ];
    }
}
