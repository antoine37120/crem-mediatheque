<?php

namespace App\Filament\Resources\AudioItemResource\Pages;

use App\Filament\Resources\AudioItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditAudioItem extends EditRecord
{
    use EditTranslatable;
    protected static string $resource = AudioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
