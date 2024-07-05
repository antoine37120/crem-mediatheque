<?php

namespace App\Filament\Resources\PlaylistResource\Pages;

use App\Filament\Resources\PlaylistResource;
use Filament\Actions;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;
use Filament\Resources\Pages\ListRecords;

class ListPlaylists extends ListRecords
{
    //use ListTranslatable;
    protected static string $resource = PlaylistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
