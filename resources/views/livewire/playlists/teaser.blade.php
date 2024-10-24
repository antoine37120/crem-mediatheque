<div>
    <div class="card-track bg-transparent position-relative" >
        <div class="position-relative w-75">
            <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $playlist->randomColor() }};"/>
        </div>
        <div class="py-2">
            <h5 class="playlist-title"><a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
            <p class="fs-5">
                {{ $playlist->description }}
            </p>
        </div>
    </div>

</div>
