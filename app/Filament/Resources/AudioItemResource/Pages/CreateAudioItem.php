<?php

namespace App\Filament\Resources\AudioItemResource\Pages;

use App\Filament\Resources\AudioItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;

class CreateAudioItem extends CreateRecord
{
    use CreateTranslatable;
    protected static string $resource = AudioItemResource::class;
}
