<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function show(string $id): View
    {
        return view('app-pages.playlist', [
            'playlist' => Playlist::findOrFail($id)
        ]);
    }
}
