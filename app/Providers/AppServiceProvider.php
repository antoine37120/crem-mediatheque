<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Notifications\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        /*TextColumn::configureUsing(function (TextColumn $column): void {
            // match `translations.title` or `translation.title`
            if (Str::match('@^translation?\.(\w+)$@', $column->getName())) {
                $column
                    ->searchable(query: function (Builder $query, string $search) use ($column): Builder {
                        $columnName = Str::after($column->getName(), '.');
                        if ($query->hasNamedScope('whereTranslationLike')) {
                            // @var Translatable|TranslatableContract $query 
                            return $query->whereTranslationLike($columnName, "%{$search}%");
                        }
        
                        return $query->where($columnName, 'like', "%{$search}%");
                    });
            }
        });*/

    }
}
