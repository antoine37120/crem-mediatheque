<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Playlist extends Model
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
        /*'name',
        'description',*/
        'picture',
    ];

    

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
}
