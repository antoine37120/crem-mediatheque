<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeographicalAreaResource\Pages;
use App\Filament\Resources\GeographicalAreaResource\RelationManagers;
use App\Models\GeographicalArea;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;

class GeographicalAreaResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = GeographicalArea::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),*/
                

                TranslatableTabs::make()->columnSpan(2)
                    ->localeTabSchema(fn (TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('name'))
                            // required only for the main locale
                            ->required($tab->isMainLocale())
                            ->maxLength(255)
                            // generate slug for the item based on the main locale
                            /*->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) use ($tab) {
                                if ($tab->isMainLocale()) {
                                    $set('slug', Str::slug($state));
                                }
                            }),*/,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translations.name')->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
                Tables\Columns\TextColumn::make('translation.name')->label('Name'),
                 
                /*Tables\Columns\TextColumn::make('locales')
                    ->state(function (GeographicalArea $record): array {
                        return $record->locales();
                    })*/
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeographicalAreas::route('/'),
            'create' => Pages\CreateGeographicalArea::route('/create'),
            'edit' => Pages\EditGeographicalArea::route('/{record}/edit'),
        ];
    }

    
    public static function getGlobalSearchResultTitle(\Illuminate\Database\Eloquent\Model $record): \Illuminate\Contracts\Support\Htmlable | string
    {
        return $record->name;
    }
}
