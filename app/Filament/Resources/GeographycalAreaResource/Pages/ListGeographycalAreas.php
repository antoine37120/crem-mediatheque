<?php

namespace App\Filament\Resources\GeographycalAreaResource\Pages;

use App\Filament\Resources\GeographycalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeographycalAreas extends ListRecords
{
    protected static string $resource = GeographycalAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
