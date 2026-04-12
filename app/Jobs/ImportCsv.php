<?php

namespace App\Jobs;

use Filament\Actions\Imports\Jobs\ImportCsv as BaseImportCsv;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class ImportCsv extends BaseImportCsv
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    public function handle(): void
    {
        /** @var Authenticatable $user */
        $user = $this->import->user;

        if (method_exists(auth()->guard(), 'login')) {
            auth()->login($user);
        } else {
            auth()->setUser($user);
        }

        $exceptions = [];

        $processedRows = 0;
        $successfulRows = 0;

        if (! is_array($this->rows)) {
            $rows = unserialize(base64_decode($this->rows));
        }

        foreach (($rows ?? $this->rows) as $row) {
            $row = $this->utf8Encode($row);

            try {
                DB::transaction(fn () => ($this->importer)($row));
                $successfulRows++;
            } catch (RowImportFailedException $exception) {
                $this->logFailedRow($row, $exception->getMessage());
            } catch (ValidationException $exception) {
                $this->logFailedRow($row, collect($exception->errors())->flatten()->implode(' '));
            } catch (Throwable $exception) {
                $exceptions[$exception::class] = $exception;

                $this->logFailedRow($row, $exception->getMessage());
            }

            $processedRows++;
        }

        $this->import->refresh();

        $importProcessedRows = $this->import->processed_rows + $processedRows;
        $this->import->processed_rows = ($importProcessedRows < $this->import->total_rows) ?
            $importProcessedRows :
            $this->import->total_rows;

        $importSuccessfulRows = $this->import->successful_rows + $successfulRows;
        $this->import->successful_rows = ($importSuccessfulRows < $this->import->total_rows) ?
            $importSuccessfulRows :
            $this->import->total_rows;

        $this->import->save();

        // Si c'est le dernier chunk, supprimer les fichiers MP3 originaux du dossier import/ si l'import est un succes total
        if ($this->import->processed_rows >= $this->import->total_rows) {
            $filesToDelete = $this->importer->filesToDelete ?? [];

            if (!empty($filesToDelete) && $this->import->getFailedRowsCount() === 0) {
                foreach ($filesToDelete as $file) {
                    try {
                        Storage::delete($file);
                    } catch (Throwable $e) {
                        Log::error("Erreur suppression fichier MP3 {$file} : " . $e->getMessage());
                    }
                }
            } elseif (!empty($filesToDelete)) {
                Log::warning("Import avec erreurs - les fichiers MP3 restent dans le dossier import/ : " . count($filesToDelete) . " fichier(s) non supprime(s)");
            }
        }

        $this->handleExceptions($exceptions);
    }
}
