<?php

namespace App\Filament\Resources\CmsPageResource\Pages;

use App\Filament\Resources\CmsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreateCmsPage extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = CmsPageResource::class;
}
