<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Arr;
use App\Models\AudioItemPlaylist;
use Illuminate\Support\Facades\DB;

class Playlist extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        /*'name',
        'description',*/
        'type_id',
        'picture',
        'published',
    ];


    /**
     * Get random color for entity.
     */
    public function randomColor() {
        $conf_colors = config('custom.items_colors');
        return Arr::random($conf_colors) ;

    }

    /**
     * Get the audio item's geographical area.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(\App\Models\PlaylistType::class)->withDefault();
    }

    /**
     * The audio items that belong to the playlist.
     */
    public function audio_item_playlists(): HasMany
    {
        return $this->hasMany(\App\Models\AudioItemPlaylist::class, 'playlist_id', 'id');
    }

    public function audio_items() {
        return \App\Models\AudioItemPlaylist::query()
        ->join('audio_items', 'audio_item_playlists.audio_item_id', 'audio_items.id')
        ->where('audio_items.published', 1)
        ->where('playlist_id', $this->id)
        ->orderBy('sort', 'asc')
        ->get();
    }



    /**
     * Return the playlist before the current playlist in ID order
     */
    public function playlistBefore() {
        $prev = Playlist::query()->where('id', '<', $this->id)
        ->where('type_id', $this->type_id)
            ->where('published', 1)
        ->orderBy('id', 'desc')->get()
        ->first() ;
        return $prev ;
    }

    /**
     * Return the playlist after the current playlist in ID order
     */
    public function playlistAfter() {
        $next = Playlist::query()->where('id', '>', $this->id)
        ->where('type_id', $this->type_id)
            ->where('published', 1)
        ->orderBy('id', 'asc')->get()
        ->first() ;
        return $next ;
    }

        /**
     * Return the podcast before the current podcast in ID order
     */
    public function podcastBefore() {
        $prev = Playlist::query()->where('id', '<', $this->id)
        ->where('type_id', $this->type_id)
            ->where('published', 1)
        ->orderBy('id', 'desc')->get()
        ->first() ;
        return $prev ;
    }

    /**
     * Return the podcast after the current podcast in ID order
     */
    public function podcastAfter() {
        $next = Playlist::query()->where('id', '>', $this->id)
        ->where('type_id', $this->type_id)
            ->where('published', 1)
        ->orderBy('id', 'asc')->get()
        ->first() ;
        return $next ;
    }
}
