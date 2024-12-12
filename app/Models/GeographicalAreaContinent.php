<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class GeographicalAreaContinent extends Model implements TranslatableContract
{
    
    use HasFactory;
    use Translatable;

    public $useTranslationFallback = true;
    public $translatedAttributes = ['name'];

    public $timestamps = false;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'continent_code',
    ];

    
    public function geographical_areas(): HasMany
    {
        return $this->hasMany(\App\Models\GeographicalArea::class, 'geographical_area_continent_id', 'id');
    }
}
