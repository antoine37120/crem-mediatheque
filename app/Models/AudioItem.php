<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AudioItem extends Model
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
    ];

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
