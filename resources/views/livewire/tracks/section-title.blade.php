<div>

    <div class="page-title">
    @if ($track->itemBefore($playlist_id) != null)
        {{-- prev --}}
    <a href="{{route('track', ['audioItem' => $track->itemBefore($playlist_id)?->audio_item_id, "playlist" => $playlist_id])}}" wire:navigate class="d-inline-block fs-2 text-white text-decoration-none align-top p-1"> < </a>
    @endif
    @if ($track->itemAfter() != null)
        {{-- next --}}
    <a href="{{route('track', ['audioItem' => $track->itemAfter()?->audio_item_id])}}" wire:navigate class="d-inline-block fs-2 text-white text-decoration-none align-top p-1"> ></a>
    @endif
    <h2 class="d-inline-block align-top pt-1">{{ $track->translate(App::getLocale(), true)->name }}</h2>
    </div>

</div>
