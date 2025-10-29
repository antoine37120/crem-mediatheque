<div>
    <div class="page-title">
        <div class="hstack gap-3 p-0">
            <div class="p-0 align-self-start">
                <div class="hstack gap-1 m-0">
                    <div class="px-0">
                        @if ($podcast->podcastBefore() != null)
                            <a href="{{route('podcast', ['podcast' => $podcast->podcastBefore()?->id])}}"
                               wire:navigate
                               class="d-inline-block text-white text-decoration-none align-top p-0 bg-white"
                               style="--bs-bg-opacity: .1;"
                            >
                                <x-heroicon-o-chevron-left
                                    style="width: 28px;height: 32px" />
                            </a>
                        @endif
                    </div>
                    <div class="px-0">
                        @if ($podcast->podcastAfter() != null)
                            <a href="{{route('podcast', ['podcast' => $podcast->podcastAfter()?->id])}}"
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
                    <div class="d-none d-lg-block col-2 col-xl-1 p-0">
                        <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $podcast->randomColor() }};" width="150" height="150"/>
                    </div>
                    <div class="col-12 col-lg-10 col-xl-11">
                        <h2 class="mb-0 mb-lg-2">{{ $podcast->translate(App::getLocale(), true)->name }}</h2>
                        <div class="d-none d-lg-block all-p-no-mb fw-light">{!! $podcast->translate(App::getLocale(), true)->description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
