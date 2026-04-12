<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Actions\Imports\Models\Import;

class ImportWarning extends Model
{
    protected $fillable = ['import_id', 'message'];

    public function import(): BelongsTo
    {
        return $this->belongsTo(Import::class);
    }
}
