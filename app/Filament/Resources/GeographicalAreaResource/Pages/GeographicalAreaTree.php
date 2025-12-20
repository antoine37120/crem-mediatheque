<?php

namespace App\Filament\Resources\GeographicalAreaResource\Pages;

use App\Filament\Resources\GeographicalAreaResource;
use Filament\Actions\CreateAction;
use SolutionForest\FilamentTree\Actions;
use SolutionForest\FilamentTree\Concern;
use SolutionForest\FilamentTree\Resources\Pages\TreePage as BasePage;
use SolutionForest\FilamentTree\Support\Utils;

use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;

class GeographicalAreaTree extends BasePage
{
    protected static string $resource = GeographicalAreaResource::class;

    protected static int $maxDepth = 2;

    protected function getEditFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('region_code')
                ->required()
                ->maxLength(255),

            TranslatableTabs::make()->columnSpan(2)
                ->localeTabSchema(fn (TranslatableTab $tab) => [
                    Forms\Components\TextInput::make($tab->makeName('name'))
                        ->required($tab->isMainLocale())
                        ->maxLength(255),
                ]),
        ];
    }

    protected function getCreateFormSchema(): array
    {
        return $this->getEditFormSchema();
    }

    protected function getEditAction(): Actions\EditAction
    {
        return Actions\EditAction::make()
            ->mutateRecordDataUsing(function (array $data, Model $record): array {
                $record->load('translations');
                foreach ($record->translations as $translation) {
                    $data[$translation->locale] = [
                        'name' => $translation->name,
                    ];
                }
                return $data;
            })
            ->using(function (Model $record, array $data): Model {
                $translations = [];
                $mainData = [];
                foreach ($data as $key => $value) {
                    if (in_array($key, config('translatable.locales', ['fr', 'en']))) {
                        $translations[$key] = $value;
                    } else {
                        $mainData[$key] = $value;
                    }
                }
                $record->update($mainData);
                foreach ($translations as $locale => $fields) {
                    foreach ($fields as $field => $value) {
                        $record->translateOrNew($locale)->$field = $value;
                    }
                }
                $record->save();
                return $record;
            });
    }

    protected function getCreateAction(): CreateAction
    {
        return CreateAction::make()
            ->using(function (array $data, string $model): Model {
                $translations = [];
                $mainData = [];
                foreach ($data as $key => $value) {
                    if (in_array($key, config('translatable.locales', ['fr', 'en']))) {
                        $translations[$key] = $value;
                    } else {
                        $mainData[$key] = $value;
                    }
                }
                $record = new $model($mainData);
                foreach ($translations as $locale => $fields) {
                    foreach ($fields as $field => $value) {
                        $record->translateOrNew($locale)->$field = $value;
                    }
                }
                $record->save();
                return $record;
            });
    }

    protected function getActions(): array
    {
        return [
            $this->getCreateAction(),
        ];
    }

    protected function hasDeleteAction(): bool
    {
        return false;
    }

    protected function hasEditAction(): bool
    {
        return true;
    }

    protected function hasViewAction(): bool
    {
        return false;
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    public function getTreeRecordTitle(?Model $record = null): string
    {
        if (!$record) {
            return '';
        }

        $count = $record->translations->filter(fn ($translation) => !empty($translation->name))->count();

        return "{$record->region_code} ({$count} translations)";
    }
}