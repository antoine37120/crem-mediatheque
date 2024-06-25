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
     * Get the phone associated with the user.
     */
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Playlist::class);
    }

    
}
