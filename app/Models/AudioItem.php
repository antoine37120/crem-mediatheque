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
use App\Models\AudioItemPlaylist;
use Filament\Notifications\Notification;

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

    public function durationFormated() {
        return ltrim(gmdate("i:s", $this->duration), '0') ;
    }

    public function calculateDuration() {
        if($this->file == null) {
            Notification::make()
            ->title('No audio file found')
            ->warning()
            ->send();

            return ;
        }

        $sys_path = Storage::path('audio-item-sound/'.$this->file);
        $audio = new Mp3Info($sys_path);
        $this->duration = round($audio->duration, 0) ;
        $this->save() ;
    }

    public function generatePicture() {
        if($this->file == null) {
            Notification::make()
            ->title('No audio file found')
            ->warning()
            ->send();

            return ;
        }
        $pathMP3 = Storage::path($this->file);
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


        Notification::make()
        ->title('Picture generated')
        ->success()
        ->send();

        return ;
    }

    /**
     * Get the audio item's geographical area.
     */
    public function geographicalArea(): BelongsTo
    {
        return $this->belongsTo(\App\Models\GeographicalArea::class)->withDefault();
    }

    /**
     * Return the item before the current item in the first playlist.
     *
     * @return \App\Models\AudioItemPlaylist|null
     */
    public function itemBefore($playlist_id = null) {
        // ajout ID playslist en paramètre, si difft de 0, supprimer ligne suivante
        if ($playlist_id == null) {
            $itemplaylist = $this->playlists()->first() ;
            $playlist_id = $itemplaylist->playlist_id ;
        }
        //Log::debug($itemplaylist) ;
        if ($itemplaylist->sort==null)
        {
            $itemplaylist->sort=0;
        }
        $prev = AudioItemPlaylist::where('playlist_id', $playlist_id)
        ->where('sort', '<=', $itemplaylist->sort)
        ->where('audio_item_id', '!=', $itemplaylist->audio_item_id)
        ->orderBy('sort', 'desc')
        ->orderBy('audio_item_id', 'desc')
        ->first() ;

        //Log::debug($prev) ;
        //return $playlist ;
        return $prev ;
    }

    /**
     * Return the item after the current item in the first playlist.
     *
     * @return \App\Models\AudioItemPlaylist|null
     */
    public function itemAfter() {
        $itemplaylist = $this->playlists()->first() ;
        if ($itemplaylist->sort==null)
        {
            $itemplaylist->sort=0;
        }
        $next = AudioItemPlaylist::where('playlist_id', $itemplaylist->playlist_id)
        ->where('sort', '>=', $itemplaylist->sort)
        ->where('audio_item_id', '!=', $itemplaylist->audio_item_id)
        ->orderBy('sort', 'asc')
        ->orderBy('audio_item_id', 'asc')
        ->first() ;
        //Log::debug($itemplaylist) ;
        //Log::debug('$next') ;
        //Log::debug($next) ;
        return $next ;
        //return $playlist->audio_item_playlists()->where('position', '>', $this->position)->orderBy('position', 'desc')->first();
    }
    /**
     * The playlists that belong to the audio item.
     */
    public function playlists(): HasMany
    {
        return $this->hasMany(\App\Models\AudioItemPlaylist::class, 'audio_item_id', 'id');
    }
}
