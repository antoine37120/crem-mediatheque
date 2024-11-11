<div>
    <div class="">
        @if ($playlist->playlistBefore() != null)
        <a href="{{route('playlist', ['playlist' => $playlist->playlistBefore()?->id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> < prev</a>
        @endif
        @if ($playlist->playlistAfter() != null)
        <a href="{{route('playlist', ['playlist' => $playlist->playlistAfter()?->id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> next ></a>
        @endif
        {{-- <h2 class="d-inline-block w-75 align-top pt-1">{{ $podcast->translate(App::getLocale(), true)->name }}</h2> --}}
        <h2>{{ $playlist->translate(App::getLocale(), true)->name }}</h2>
    </div>
</div>
