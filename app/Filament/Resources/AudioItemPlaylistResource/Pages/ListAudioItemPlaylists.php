<?php

namespace App\Filament\Resources\AudioItemPlaylistResource\Pages;

use App\Filament\Resources\AudioItemPlaylistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAudioItemPlaylists extends ListRecords
{
    protected static string $resource = AudioItemPlaylistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
