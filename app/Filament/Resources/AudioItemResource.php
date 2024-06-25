<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AudioItemResource\Pages;
use App\Filament\Resources\AudioItemResource\RelationManagers;
use App\Models\AudioItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AudioItemResource extends Resource
{
    protected static ?string $model = AudioItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->required(),
                Forms\Components\Select::make('geographical_area_id')
                    ->relationship('geographicalArea', 'name'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('file')
                    ->required()
                    ->preserveFilenames(),
                Forms\Components\Textarea::make('interpreters')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('collector')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('picture')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year'),
                Tables\Columns\TextColumn::make('geographicalArea.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('collector')
                    ->searchable(),
                Tables\Columns\TextColumn::make('picture')
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
            'index' => Pages\ListAudioItems::route('/'),
            'create' => Pages\CreateAudioItem::route('/create'),
            'edit' => Pages\EditAudioItem::route('/{record}/edit'),
        ];
    }
}
