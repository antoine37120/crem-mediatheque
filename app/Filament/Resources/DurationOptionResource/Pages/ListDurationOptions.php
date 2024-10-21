<?php

namespace App\Filament\Resources\DurationOptionResource\Pages;

use App\Filament\Resources\DurationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDurationOptions extends ListRecords
{
    protected static string $resource = DurationOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
