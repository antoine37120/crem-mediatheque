<?php

namespace App\Filament\Resources\AudioItemResource\Pages;

use App\Filament\Resources\AudioItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;

class EditAudioItem extends EditRecord
{
    use EditTranslatable;
    protected static string $resource = AudioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('make_picture')->label('Generate picture')
            //->requiresConfirmation()
            //->action(fn () => $this->record->generatePicture())
            ->action(function ($record) {
                $this->record->generatePicture() ;
                $this->fillForm();
            }),
            Actions\Action::make('calc_duration')->label('Define duration') 
            //->requiresConfirmation()
            //->action(fn () => $this->record->generatePicture())
            ->action(function ($record) {
                $this->record->calculateDuration() ;
                $this->fillForm();
            }),
            Actions\DeleteAction::make()
            ->requiresConfirmation(),
        ];
    }
}