<?php

namespace App\Filament\Resources\AudioItemResource\Pages;

use App\Filament\Resources\AudioItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAudioItem extends EditRecord
{
    protected static string $resource = AudioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
