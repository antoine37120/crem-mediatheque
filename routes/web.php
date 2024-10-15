<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AppLayer;


Route::localized(function () {
    //Route::get('/', AppLayer::class);

    Route::get('/', function () {
        return view('app-pages.home', []);
    });
    Route::get('/tracks', function () {
        return view('app-pages.tracks', []);
    });
    Route::get('/playlists', function () {
        return view('app-pages.playlists', []);
    });
    Route::get('/podcasts', function () {
        return view('app-pages.podcasts', []);
    });
    Route::get('/about', function () {
        return view('app-pages.about', []);
    });
});


