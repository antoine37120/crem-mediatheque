<div>
    <div class="">
        {{-- @if ($podcast->itemBefore() != null)
        <a href="{{route('podcast', ['podcast' => $podcast->itemBefore()?->podcast_id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> < prev</a>
        @endif --}}
        {{-- @if ($podcast->itemAfter() != null) --}}
        {{-- <a href="{{route('podcast', ['podcast' => $podcast->itemAfter()?->podcast_id])}}" wire:navigate class="d-inline-block text-white align-top p-1"> next ></a> --}}
        {{-- @endif --}}
        {{-- <h2 class="d-inline-block w-75 align-top pt-1">{{ $podcast->translate(App::getLocale(), true)->name }}</h2> --}}
        <h2>title podcast </h2>
    </div>
</div>
