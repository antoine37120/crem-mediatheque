<?php

namespace App\Filament\Resources\DurationOptionResource\Pages;

use App\Filament\Resources\DurationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;

class ListDurationOptions extends ListRecords
{
    use ListTranslatable;
    protected static string $resource = DurationOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
