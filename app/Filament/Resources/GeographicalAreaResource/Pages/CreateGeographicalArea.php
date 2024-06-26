<?php

namespace App\Filament\Resources\GeographicalAreaResource\Pages;

use App\Filament\Resources\GeographicalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGeographicalArea extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = GeographicalAreaResource::class;
 
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
