<?php

namespace App\Filament\Resources\PlaylistResource\Pages;

use App\Filament\Resources\PlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditPlaylist extends EditRecord
{
    use EditTranslatable;
    protected static string $resource = PlaylistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
