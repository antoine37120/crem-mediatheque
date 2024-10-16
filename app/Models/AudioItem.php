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
use JustWave;
use Illuminate\Support\Arr;

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
    
    /**
     * Get random color for entity.
     */
    public function randomColor() {
        $conf_colors = config('custom.items_colors');
        return Arr::random($conf_colors) ;

    }

    public function calculateDuration() {
        
        $sys_path = Storage::path('audio-item-sound/'.$this->cote.'.mp3');
        $audio = new Mp3Info($sys_path);
        $this->duration = round($audio->duration, 0) ;
        $this->save() ;
    }

    public function generatePicture() {
        $pathMP3 = Storage::path('audio-item-sound/'.$this->cote.'.mp3');
        $pathMP3 = str_replace('\\', '/', $pathMP3);
        $pathIMG = Storage::path('audio-item-image/');
        $args = [
            'width=600',
            'height=600', 
            'wave_color=#ffffff', 
            'back_color=transparent',
            'wavedir='.$pathIMG,
            'nocache=true',
            'mode=file'
        ];
        $justwave = new JustWave('ARGV', $args);
        $log = $justwave->create($pathMP3);

        $pathFile = 'audio-item-image/'.$this->cote.'.png' ;
        Storage::move('audio-item-image/'.$log->key.'.png', $pathFile );
        Storage::delete('audio-item-image/'.$log->key.'_bg.png');
        
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
