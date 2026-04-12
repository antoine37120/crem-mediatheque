<div class="space-y-4">
    @foreach ($import->failedRows as $failedRow)
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-start">
                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100">
                        Ligne #{{ $failedRow->data['original_name'] ?? $failedRow->data['name'] ?? 'Inconnue' }}
                    </span>
                    <span class="px-2 py-1 text-xs font-medium bg-danger-50 text-danger-700 rounded-full">
                        Erreur de validation
                    </span>
                </div>

                <div class="text-sm text-gray-600 dark:text-gray-400 italic">
                    {{ $failedRow->validation_error }}
                </div>

                <div class="mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                    <details class="text-xs">
                        <summary class="cursor-pointer text-primary-600 hover:text-primary-500 font-medium">Voir les données brutes</summary>
                        <pre class="mt-2 p-2 bg-gray-50 dark:bg-gray-900 rounded overflow-x-auto text-[10px]">{{ json_encode($failedRow->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </details>
                </div>
            </div>
        </div>
    @endforeach
</div>
