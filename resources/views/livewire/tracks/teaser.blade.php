<div>
    <div class="card-track bg-transparent position-relative" >
        <div class="row justify-content-between flex-nowrap mx-0">
            {{-- w-75 --}}
            <div class="col-8 position-relative p-0" style="width: fit-content">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $track->getHexaColor() }};" width="150" height="150"/>
                <div class="position-absolute top-0 start-0 text-white ps-1">
                {{ $track->year }}
                </div>
                <div class="position-absolute bottom-0 end-0 text-white pe-1">
                {{ $track->durationFormated() }}
                </div>
                <div class="card-track-actions position-absolute top-0 end-0 p-1">
                    <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                </div>
                {{-- <div class="d-none d-lg-block card-track-actions position-absolute bottom-0 start-0 p-2">
                    <a href="{{ $track->link }}" target="_blank"class="btn btn-light rounded-circle p-0 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
                        </svg>
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="py-2">
            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale(), true)->name, 50, '...') }}</a></h5>
            <p class="fs-6">{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</p>
        </div>
    </div>

</div>
