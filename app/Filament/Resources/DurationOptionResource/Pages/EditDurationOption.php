<?php

namespace App\Filament\Resources\DurationOptionResource\Pages;

use App\Filament\Resources\DurationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditDurationOption extends EditRecord
{
    use EditTranslatable;
    protected static string $resource = DurationOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
