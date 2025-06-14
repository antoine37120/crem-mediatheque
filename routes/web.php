<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AppLayer;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\AppPageController;

Route::localized(function () {
    //Route::get('/', AppLayer::class);

    Route::get('/', function () {
        return view('app-pages.home', []);
    })->name('home');


    Route::get('/tracks', function () {
        return view('app-pages.search-tracks', ['search' => '']);
    })->name('tracks');

    Route::get('track/{audioItem:id}/{playlist:id?}', [TrackController::class, 'show'])->name('track');

    Route::get('/playlists', function () {
        return view('app-pages.playlists', []);
    })->name('playlists');

    Route::get('playlist/{playlist:id}', [PlaylistController::class, 'show'])->name('playlist');

    Route::get('/podcasts', function () {
        return view('app-pages.podcasts', []);
    })->name('podcasts');

    Route::get('podcast/{podcast:id}', [PodcastController::class, 'show'])->name('podcast');

    Route::get('page/{cmsPage:slug}', [AppPageController::class, 'show'])->name('cmsPage');
});


