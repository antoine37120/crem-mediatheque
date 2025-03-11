<div>

    <div class="page-title">
        <div class="row justify-content-between">
            <div class="col-4">
            @if ($prev_id != null)
                {{-- prev --}}
                <a href="{{route('track', ['audioItem' => $prev_id])}}" wire:navigate class="d-inline-block fs-2 text-white text-decoration-none align-top p-1"> < </a>
            @endif
            </div>
            <div class="col-4 text-end">
            @if ($next_id != null)
                {{-- next --}}
                <a href="{{route('track', ['audioItem' => $next_id])}}" wire:navigate class="d-inline-block fs-2 text-white text-decoration-none align-top p-1"> ></a>
            @endif
            </div>
        </div>

        <h2 class="d-inline-block align-top pt-1 h4">{{ $track->translate(App::getLocale(), true)->name }}</h2>
    </div>

</div>
