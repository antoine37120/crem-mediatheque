<?php

namespace App\Jobs;

use Filament\Actions\Imports\Jobs\ImportCsv as BaseImportCsv;

class ImportCsv extends BaseImportCsv
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;
}
