<?php

namespace App\Filament\Resources\GeographicalAreaResource\Pages;

use App\Filament\Resources\GeographicalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeographicalAreas extends ListRecords
{
    

    protected static string $resource = GeographicalAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
