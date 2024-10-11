<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AppLayer;
use App\Http\Controllers\BrowsershotController;
use App\Http\Controllers\WavePictureController;

Route::get('/', AppLayer::class);

Route::get('/audio-wave-browsershot/{id}/{file}', [BrowsershotController::class, 'show']);
Route::get('/wave-picture/{id}/{file}', [WavePictureController::class, 'show']);