<div>
    <div class="">
        @if ($podcast->podcastBefore() != null)
        <a href="{{route('podcast', ['podcast' => $podcast->podcastBefore()?->id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> < prev</a>
        @endif
        @if ($podcast->podcastAfter() != null)
        <a href="{{route('podcast', ['podcast' => $podcast->podcastAfter()?->id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> next ></a>
        @endif
        {{-- <h2 class="d-inline-block w-75 align-top pt-1">{{ $podcast->translate(App::getLocale(), true)->name }}</h2> --}}
        <h2>{{ $podcast->translate(App::getLocale(), true)->name }}</h2>
    </div>
</div>
