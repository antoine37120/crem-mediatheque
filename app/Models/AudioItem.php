<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use wapmorgan\Mp3Info\Mp3Info;
use Illuminate\Support\Number;

class AudioItem extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        /*'name',*/
        'duration',
        'year',
        'geographical_area_id',
        /*'description',*/
        'file',
        'interpreters',
        'collector',
        'picture',
        'cote',
        'link',
        'original_name'
    ];

    public function calculateDuration() {
        
        $sys_path = Storage::path('audio-item-sound/'.$this->cote.'.mp3');
        $audio = new Mp3Info($sys_path);
        $this->duration = round($audio->duration, 0) ;
        $this->save() ;
    }

    public function generatePicture() {
        $dataImage = Browsershot::url(url('wave-picture', [$this->id, $this->cote.'.mp3']))
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
        //Log::info(print_r(url('wave-picture', [$this->record->id, $this->record->file]), true));
        //Log::info(print_r(env('CUSTOM_NpmBinaryPath', false), true));
        $data = str_replace(' ','+',$dataImage);
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $decodedData = base64_decode($data);
        $pathFile = 'audio-item-image/'.$this->cote.'.png' ;
        Storage::put($pathFile, $decodedData);
        $this->picture = $pathFile;
        $this->save() ;
    }

    /**
     * Get the audio item's geographical area.
     */
    public function geographicalArea(): BelongsTo
    {
        return $this->belongsTo(\App\Models\GeographicalArea::class)->withDefault();
    }
    /**
     * The playlists that belong to the audio item.
     */
    public function playlists(): HasMany
    {
        return $this->hasMany(\App\Models\AudioItemPlaylist::class, 'audio_item_id', 'id');
    }
}
