<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmsPageResource\Pages;
use App\Filament\Resources\CmsPageResource\RelationManagers;
use App\Models\CmsPage;
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
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CmsPageResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = CmsPage::class;

    protected static ?string $navigationLabel = 'Pages CMS';
    
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-s-bars-3-center-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
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
                    Forms\Components\RichEditor::make($tab->makeName('content'))
                    // required only for the main locale
                    ->columnSpanFull()
                    // generate slug for the item based on the main locale
                    /*->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) use ($tab) {
                        if ($tab->isMainLocale()) {
                            $set('slug', Str::slug($state));
                        }
                    }),*/
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
            'index' => Pages\ListCmsPages::route('/'),
            'create' => Pages\CreateCmsPage::route('/create'),
            'edit' => Pages\EditCmsPage::route('/{record}/edit'),
        ];
    }

        
    
    public static function getGloballySearchableAttributes(): array
    {
        return ['translations.name', 'translations.content'];
    }

    public static function getGlobalSearchResultTitle(\Illuminate\Database\Eloquent\Model $record): \Illuminate\Contracts\Support\Htmlable | string
    {
        return $record->name;
    }
}
