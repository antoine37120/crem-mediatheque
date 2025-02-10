<div>
    <div class="page-title">
        @if ($playlist->playlistBefore() != null)
        <a href="{{route('playlist', ['playlist' => $playlist->playlistBefore()?->id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> < prev</a>
        @endif
        @if ($playlist->playlistAfter() != null)
        <a href="{{route('playlist', ['playlist' => $playlist->playlistAfter()?->id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> next ></a>
        @endif
        <h2>{{ $playlist->translate(App::getLocale(), true)->name }}</h2>
    </div>
</div>
