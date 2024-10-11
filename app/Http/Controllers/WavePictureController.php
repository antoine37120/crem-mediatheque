<?php

namespace App\Http\Controllers;

use App\Models\AudioItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WavePictureController extends Controller
{
    
    /**
     * génrate and show the picture for audio item.
     */
    public function show(string $id, string $file): View
    {
        //$file = 'CNRSMH_I_1970_013_001_02.mp3' ;
        return view('wavepicture', [
            //'audioItem' => AudioItem::findOrFail($id),
            'file' => 'audio-item-sound/'.$file
        ]);
    }
}
