<?php

namespace App\Filament\Resources\YearOptionResource\Pages;

use App\Filament\Resources\YearOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreateYearOption extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = YearOptionResource::class;
}
