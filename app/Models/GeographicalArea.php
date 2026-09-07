<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\DB;

use SolutionForest\FilamentTree\Concern\ModelTree;

class GeographicalArea extends Model implements TranslatableContract
{
    use HasFactory;
    use ModelTree;
    use Translatable;

    protected static function booted(): void
    {
        // Garde-fou : jamais de suppression d'une aire encore utilisee.
        static::deleting(function (self $area): void {
            if ($reason = $area->deletionBlockReason()) {
                throw new \RuntimeException($reason);
            }
        });
    }

    /**
     * Raison bloquant la suppression de l'aire, ou null si supprimable.
     */
    public function deletionBlockReason(): ?string
    {
        $tracks = AudioItem::where('geographical_area_id', $this->id)->count();
        if ($tracks > 0) {
            return "Suppression impossible : {$tracks} piste(s) utilisent encore cette aire. Reaffectez-les d'abord.";
        }

        if ($this->childs()->exists()) {
            return "Suppression impossible : cette aire possede des sous-aires. Supprimez-les d'abord.";
        }

        return null;
    }

    public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GeographicalAreaTranslation::class);
    }

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

     public function childs() {
        return $this->hasMany(GeographicalArea::class, 'parent_id')->orderBy('sort', 'ASC');
     }

     public static function region_childs_ids($region_id) 
     {
        return DB::table('geographical_areas')
        ->select('id')
        ->where('parent_id', $region_id)
        ->orderBy('sort', 'asc')
        ->pluck('id')->toArray();
     }


}
