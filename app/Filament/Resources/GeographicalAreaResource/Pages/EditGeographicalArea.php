<?php

namespace App\Filament\Resources\GeographicalAreaResource\Pages;

use App\Filament\Resources\GeographicalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGeographicalArea extends EditRecord
{
    use EditRecord\Concerns\Translatable;
 
    protected static string $resource = GeographicalAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
