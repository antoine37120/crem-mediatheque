<div class="space-y-4">
    @foreach ($warnings as $warning)
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-start gap-4">
                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100 break-all">
                        {{ $warning->message }}
                    </span>
                    <span class="px-2 py-1 text-xs font-medium bg-warning-50 text-warning-700 rounded-full whitespace-nowrap shrink-0">
                        Avertissement
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>
