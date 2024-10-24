<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DurationOptionResource\Pages;
use App\Filament\Resources\DurationOptionResource\RelationManagers;
use App\Models\DurationOption;
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

class DurationOptionResource extends Resource
{
    use ResourceTranslatable;
    protected static ?string $model = DurationOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Search Options';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()->columnSpan(2)
                ->localeTabSchema(fn (TranslatableTab $tab) => [
                    Forms\Components\TextInput::make($tab->makeName('name'))
                        // required only for the main locale
                        ->required($tab->isMainLocale())
                        ->maxLength(255)
                ]),
                Forms\Components\TextInput::make('from')->requiredWithout('to')
                    ->numeric(),
                Forms\Components\TextInput::make('to')->requiredWithout('from')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translation.name'),
                Tables\Columns\TextColumn::make('from')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListDurationOptions::route('/'),
            'create' => Pages\CreateDurationOption::route('/create'),
            'edit' => Pages\EditDurationOption::route('/{record}/edit'),
        ];
    }
}
