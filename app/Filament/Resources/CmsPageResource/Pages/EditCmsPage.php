<?php

namespace App\Filament\Resources\CmsPageResource\Pages;

use App\Filament\Resources\CmsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditCmsPage extends EditRecord
{
    use EditTranslatable;
    
    protected static string $resource = CmsPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
