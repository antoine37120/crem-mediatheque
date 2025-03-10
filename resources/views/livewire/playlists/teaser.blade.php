<div>
    <div class="card-track bg-transparent position-relative" >
        <div class="position-relative p-0" style="width: fit-content">
            <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $playlist->randomColor() }};"/>
            <div class="card-playlist-actions position-absolute top-0 end-0 p-1">
                <livewire:playlists.list-self-actions :playlist="$playlist" wire:key="playlist-teaser-actions-{{ $playlist->id }}" />
            </div>
        </div>
        <div class="py-2 w-75 home-teaser-text">
            <h5 class="playlist-title"><a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
            <p class="fs-6 overflow-hidden text-truncate text-nowrap">
                {!! $playlist->translate(App::getLocale(), true)->description !!}
            </p>
        </div>
    </div>

</div>
