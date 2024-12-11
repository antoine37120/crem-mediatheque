<div>

    <div class="page-title">
    @if ($prev_id != null)
        {{-- prev --}}
    <a href="{{route('track', ['audioItem' => $prev_id])}}" wire:navigate class="d-inline-block fs-2 text-white text-decoration-none align-top p-1"> < </a>
    @endif
    @if ($next_id != null)
        {{-- next --}}
    <a href="{{route('track', ['audioItem' => $next_id])}}" wire:navigate class="d-inline-block fs-2 text-white text-decoration-none align-top p-1"> ></a>
    @endif
    <h2 class="d-inline-block align-top pt-1">{{ $track->translate(App::getLocale(), true)->name }}</h2>
    </div>

</div>
