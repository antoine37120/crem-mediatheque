<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AppLayer;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\AppPageController;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Gate;
use League\Csv\ByteSequence;
use League\Csv\Writer;

Route::get('crem-admin/imports/{import}/failed-rows/download', function (Import $import) {
    if (filled(Gate::getPolicyFor($import::class))) {
        authorize('view', $import);
    } else {
        abort_unless($import->user()->is(auth()->user()), 403);
    }

    $csv = Writer::createFromFileObject(new SplTempFileObject());
    $csv->setOutputBOM(ByteSequence::BOM_UTF8);

    $columnHeaders = array_keys($import->failedRows()->first()->data);
    $columnHeaders[] = 'Erreur';

    $csv->insertOne($columnHeaders);

    $import->failedRows()->lazyById(100)->each(fn ($failedRow) => $csv->insertOne([
        ...$failedRow->data,
        'error' => $failedRow->validation_error ?? 'Erreur systeme',
    ]));

    return response()->streamDownload(function () use ($csv) {
        foreach ($csv->chunk(1000) as $offset => $chunk) {
            echo $chunk;
            if ($offset % 1000) { flush(); }
        }
    }, "import-{$import->getKey()}-erreurs.csv", ['Content-Type' => 'text/csv']);
})->middleware(['web', 'auth'])->name('crem-admin.imports.failed-rows.download');

Route::localized(function () {
    //Route::get('/', AppLayer::class);

    Route::get('/', function () {
        return view('app-pages.home', []);
    })->name('home');


    Route::get('/tracks', function () {
        return view('app-pages.search-tracks', ['search' => '']);
    })->name('tracks');

    Route::get('tracks/{audioItem:id}/{playlist:id?}', [TrackController::class, 'show'])->name('track');

    Route::get('/playlists', function () {
        return view('app-pages.playlists', []);
    })->name('playlists');

    Route::get('playlists/{playlist:id}', [PlaylistController::class, 'show'])->name('playlist');

    Route::get('/podcasts', function () {
        return view('app-pages.podcasts', []);
    })->name('podcasts');

    Route::get('podcasts/{podcast:id}', [PodcastController::class, 'show'])->name('podcast');

    Route::get('page/{cmsPage:slug}', [AppPageController::class, 'show'])->name('cmsPage');
});


