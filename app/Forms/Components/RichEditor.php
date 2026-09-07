<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;

class RichEditor extends \Filament\Forms\Components\RichEditor
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->hintAction(
            Action::make('edit_html_source')
                ->label('HTML')
                ->icon('heroicon-m-code-bracket')
                ->color('gray')
                ->modalWidth('2xl')
                ->form([
                    Textarea::make('html')
                        ->label('Source HTML (remplace tout le contenu)')
                        ->rows(14),
                ])
                ->mountUsing(fn (Form $form) => $form->fill([
                    'html' => (string) $this->getState(),
                ]))
                ->action(function (array $data): void {
                    // L'ecriture dans l'etat du champ suffit : le composant Alpine
                    // de Filament ecoute le state ($watch) et recharge lui-meme
                    // l'editeur Trix (loadHTML) quand la reponse Livewire arrive.
                    // Aucun event navigateur custom n'est necessaire ici.
                    $this->state((string) ($data['html'] ?? ''));
                }),
        );
    }
}
