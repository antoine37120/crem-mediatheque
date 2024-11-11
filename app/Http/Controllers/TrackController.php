<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\AudioItem;

class TrackController extends Controller
{
    public function show(string $id, string $playlist_id = null): View
    {
        return view('app-pages.track', [
            'track' => AudioItem::findOrFail($id),
            'playlist_id' =>  $playlist_id
        ]);
    }
}
