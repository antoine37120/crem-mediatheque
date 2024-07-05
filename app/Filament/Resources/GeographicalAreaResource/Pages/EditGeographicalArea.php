<?php

namespace App\Filament\Resources\GeographicalAreaResource\Pages;

use App\Filament\Resources\GeographicalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditGeographicalArea extends EditRecord
{
    use EditTranslatable;
 
    protected static string $resource = GeographicalAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
