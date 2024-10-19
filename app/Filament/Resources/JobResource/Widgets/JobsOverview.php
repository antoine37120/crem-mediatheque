<?php

namespace App\Filament\Resources\JobResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Job;
use Filament\Tables\Actions\Action;

class JobsOverview extends BaseWidget
{
    protected static ?string $model = Job::class;
    public function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->query(
                Job::query()->orderBy('id', 'asc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('queue'),
                Tables\Columns\TextColumn::make('attempts'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->actions([
                Action::make('delete')
                ->requiresConfirmation()
                ->action(fn (Job $record) => $record->delete())
            ]);
    }
}
