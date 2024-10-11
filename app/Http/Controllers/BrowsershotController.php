<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\AudioItem;

class BrowsershotController extends Controller
{
    
    function show($id, $file) {
        Log::info(print_r($file, true));
        $AudioItem = AudioItem::findOrFail($id) ;
        $dataImage = Browsershot::url(url('wave-picture', [$id, $file]))
                ->noSandbox()
                ->setNodeBinary(env('CUSTOM_NodeBinaryPath', false))
                ->setNpmBinary(env('CUSTOM_NpmBinaryPath', false))
                ->setOption('landscape', true)
                ->windowSize(600, 600)
                ->waitUntilNetworkIdle()
                //->save(storage_path() . '/laravel_screenshot_browsershot.png');
                //->bodyHtml() ;
                ->evaluate("window.pngData");
        
        /*Log::info(print_r($dataImage, true));*/
        Log::info(print_r(url('wave-picture', [$id, $file]), true));
        Log::info(print_r(env('CUSTOM_NpmBinaryPath', false), true));
        $data = str_replace(' ','+',$dataImage);
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $decodedData = base64_decode($data);
        $pathFile = 'audio-item/'.$AudioItem->cote.'.png' ;
        Storage::put($pathFile, $decodedData);
        $AudioItem->picture = $pathFile;
        $AudioItem->save() ;
    }
}
