<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearOptionTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name',
    'locale',
    'year_option_id'];
}
