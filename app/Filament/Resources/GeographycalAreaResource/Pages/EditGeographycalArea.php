<?php

namespace App\Filament\Resources\GeographycalAreaResource\Pages;

use App\Filament\Resources\GeographycalAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGeographycalArea extends EditRecord
{
    protected static string $resource = GeographycalAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
