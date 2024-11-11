<div>

    <div class="">
    @if ($track->itemBefore($playlist_id) != null)
    <a href="{{route('track', ['audioItem' => $track->itemBefore($playlist_id)?->audio_item_id, "playlist" => $playlist_id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> < prev</a>
    @endif
    @if ($track->itemAfter() != null)
    <a href="{{route('track', ['audioItem' => $track->itemAfter()?->audio_item_id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> next ></a>
    @endif
    <h2 class="d-inline-block w-75 align-top pt-1">{{ $track->translate(App::getLocale(), true)->name }}</h2>
    </div>

</div>
