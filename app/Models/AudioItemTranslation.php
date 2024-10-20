<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Laravel\Scout\Searchable;

class AudioItemTranslation extends Model
{
    use HasFactory;
    use Searchable;

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'locale',
        'audio_item_id',
    ];

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'scout_serach_index';
    }
    public function toSearchableArray()
    {
        return [
            'name' => '',
            'description' => '',
        ];
    }
    
    /**
     * Get the audio item's geographical area.
     */
    public function audioItem(): BelongsTo
    {
        return $this->belongsTo(\App\Models\AudioItem::class, 'audio_item_id', 'id');
    }
}
