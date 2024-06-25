<?php

namespace App\Filament\Resources\PlaylistResource\Pages;

use App\Filament\Resources\PlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlaylist extends CreateRecord
{
    protected static string $resource = PlaylistResource::class;

    public function mount(): void
    {
        $this->form->fill();
    }
}
