<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use SolutionForest\FilamentTree\Concern\ModelTree;

class GeographicalArea extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    
    use ModelTree;

    public $useTranslationFallback = true;
    public $translatedAttributes = ['name'];

    public $timestamps = false;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'region_code',
        'parent_id',
        'sort',
    ];
    protected $casts = [
        'parent_id' => 'int'
    ];


    public function determineOrderColumnName(): string
    {
         return "sort";
    }
 
    public function determineParentColumnName(): string
    {
         return "parent_id";
    }
 
    public function determineTitleColumnName(): string
     {
         return 'region_code';
     }


}
