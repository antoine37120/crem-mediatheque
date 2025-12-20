<div class="row py-2 border-bottom align-items-center track-item {{ $selected == $track->id ? "bg-light" : "" }}"
     x-sort:item
     data-track-url="{{ url('storage/'.$track->file) }}"
     data-track-id="{{ $track->id }}"
     style="cursor: pointer;"
     >

    <!-- Titre -->
    <div class="col-9 col-md-10">
        <div class="text-truncate" title="{{ $track->translate(App::getLocale(), true)->name }}">
            <a x-on:click.prevent="window.Livewire.navigate('{{route('track', ['audioItem' => $track->id])}}')" class="text-black text-decoration-none fw-bold">
            {{ $track->translate(App::getLocale(), true)->name }}
            </a>
        </div>
    </div>

    <!-- Année -->
    <div class="col-1 col-md-1">
        {{ $track->year }}
    </div>
    <div class="time d-none">{{ $track->durationFormated() }}</div>

    <!-- Actions -->
    <div class="col-2 col-md-1 text-end">
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn p-1" wire:click.stop="$dispatch('delete-to-playlist', { id: {{ $track->id }} })">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
            </button>
            <span class="ms-2" x-sort:handle style="cursor: grab;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-vertical" viewBox="0 0 16 16">
                    <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </span>
        </div>
    </div>
</div>
