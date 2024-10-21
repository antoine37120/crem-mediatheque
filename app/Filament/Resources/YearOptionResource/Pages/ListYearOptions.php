<?php

namespace App\Filament\Resources\YearOptionResource\Pages;

use App\Filament\Resources\YearOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListYearOptions extends ListRecords
{
    protected static string $resource = YearOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
