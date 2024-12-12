<?php

namespace App\Filament\Resources\GeographicalAreaContinentResource\Pages;

use App\Filament\Resources\GeographicalAreaContinentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeographicalAreaContinents extends ListRecords
{
    protected static string $resource = GeographicalAreaContinentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
