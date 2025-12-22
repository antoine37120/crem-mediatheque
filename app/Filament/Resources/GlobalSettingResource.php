<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GlobalSettingResource\Pages;
use App\Filament\Resources\GlobalSettingResource\RelationManagers;
use App\Models\GlobalSetting;
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

class GlobalSettingResource extends Resource
{
    use ResourceTranslatable;

    protected static ?string $model = GlobalSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->readOnly()
                    ->columnSpanFull(),
                TranslatableTabs::make()->columnSpanFull()
                    ->localeTabSchema(fn (TranslatableTab $tab) => [
                        Forms\Components\RichEditor::make($tab->makeName('value'))
                            ->label('Contenu')
                            ->required($tab->isMainLocale()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                Tables\Columns\TextColumn::make('translations.value')
                    ->label('Contenu')
                    ->html()
                    ->limit(50)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListGlobalSettings::route('/'),
            'create' => Pages\CreateGlobalSetting::route('/create'),
            'edit' => Pages\EditGlobalSetting::route('/{record}/edit'),
        ];
    }
}
