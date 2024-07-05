<?php

namespace App\Filament\Resources\PlaylistResource\Pages;

use App\Filament\Resources\PlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreatePlaylist extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = PlaylistResource::class;

    public function mount(): void
    {
        $this->form->fill();
    }
}
