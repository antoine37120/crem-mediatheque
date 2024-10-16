<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Playlist;

class PodcastController extends Controller
{
    public function show(string $id): View
    {
        return view('app-pages.podcast', [
            'podcast' => Playlist::findOrFail($id)
        ]);
    }
}
