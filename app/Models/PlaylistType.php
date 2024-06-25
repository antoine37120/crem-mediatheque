<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaylistType extends Model
{
    use HasFactory;
    public $timestamps = false;
            
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];


    
    /**
     * Get the phone associated with the user.
     */
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Playlist::class);
    }

}
