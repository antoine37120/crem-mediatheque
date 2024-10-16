<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\AudioItem;

class TrackController extends Controller
{
    public function show(string $id): View
    {
        return view('app-pages.track', [
            'track' => AudioItem::findOrFail($id)
        ]);
    }
}
