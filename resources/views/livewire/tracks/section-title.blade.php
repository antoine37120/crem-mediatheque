<div>
    <div class="page-title">
        <div class="d-flex align-items-stretch gap-3 m-0 p-0 px-lg-0">
            <div class="p-0">
                <div class="d-flex align-items-stretch gap-1">
                    <div class="col-6 px-0 text-right">
                        @if ($prev_id != null)
                            <a href="{{route('track', ['audioItem' => $prev_id, 'playlist' => $playlist_id])}}"
                               wire:navigate
                               class="d-inline-block text-white text-decoration-none align-top p-0 bg-white"
                               style="--bs-bg-opacity: .1;"
                            >
                                <x-heroicon-o-chevron-left
                                    style="width: 28px;height: 32px" />
                            </a>
                        @endif
                    </div>
                    <div class="col-6 px-0 text-left">
                        @if ($next_id != null)
                            <a href="{{route('track', ['audioItem' => $next_id, 'playlist' => $playlist_id])}}"
                               wire:navigate
                               class="d-inline-block text-white text-decoration-none align-top p-0 bg-white"
                               style="--bs-bg-opacity: .1;"
                            >
                                <x-heroicon-o-chevron-right
                                    style="width: 28px;height: 32px"
                                />
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="ps-0">
                <div class="row align-items-center m-0">
                    <div class="col-12">
                        <h2 class="mb-0 mb-lg-2">{{ $track->translate(App::getLocale(), true)->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
