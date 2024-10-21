<?php

namespace App\Filament\Resources\YearOptionResource\Pages;

use App\Filament\Resources\YearOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditYearOption extends EditRecord
{
    use EditTranslatable;
    protected static string $resource = YearOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
