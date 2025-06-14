<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AudioItemPlaylist extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sort',
        'audio_item_id',
        'playlist_id',
    ];


    /**
     * Get the audio item associated with the audio item playlists row.
     */
    public function audio_item(): BelongsTo
    {
        return $this->belongsTo(\App\Models\AudioItem::class);
    }


    /**
     * Get the playlist associated with this audio item playlist.
     */
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Playlist::class);
    }



    /**
     * Get audio_items with attribute published = true, order by sort for a playlist id
     */
    public static function getPublishedAudioItemsForPlaylist($playlist_id)
    {
        return self::where('playlist_id', $playlist_id)
            ->whereHas('audio_item', function ($query) {
                $query->where('published', 1);
            })
            ->with('audio_item')
            ->orderBy('sort', 'asc')
            ->get()
            ->pluck('audio_item');
    }





}
