<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeographicalAreaContinentResource\Pages;
use App\Filament\Resources\GeographicalAreaContinentResource\RelationManagers;
use App\Models\GeographicalAreaContinent;
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

class GeographicalAreaContinentResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = GeographicalAreaContinent::class;
    
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Continents';

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('continent_code')
                    ->required()
                    ->maxLength(255),
                TranslatableTabs::make()->columnSpan(2)
                    ->localeTabSchema(fn (TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('name'))
                            // required only for the main locale
                            ->required($tab->isMainLocale())
                            ->maxLength(255)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('continent_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('translations.name')->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                    Tables\Columns\TextColumn::make('translation.name')->label('Name'),
                
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
            RelationManagers\GeographicalAreasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeographicalAreaContinents::route('/'),
            'create' => Pages\CreateGeographicalAreaContinent::route('/create'),
            'edit' => Pages\EditGeographicalAreaContinent::route('/{record}/edit'),
        ];
    }
}
