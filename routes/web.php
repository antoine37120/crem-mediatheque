<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AppLayer;


Route::localized(function () {
    //Route::get('/', AppLayer::class);

    Route::get('/', function () {
        return view('app-pages.home', []);
    });
    
});


