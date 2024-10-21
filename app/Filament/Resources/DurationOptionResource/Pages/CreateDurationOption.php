<?php

namespace App\Filament\Resources\DurationOptionResource\Pages;

use App\Filament\Resources\DurationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreateDurationOption extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = DurationOptionResource::class;
}
