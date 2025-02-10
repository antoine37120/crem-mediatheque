<div>
    <div class="card-track bg-transparent position-relative" >
        <div class="position-relative p-0" style="width: fit-content">
            <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $podcast->randomColor() }};"/>
                              
            <div class="card-playlist-actions position-absolute top-0 end-0 p-1">
                <livewire:playlists.list-self-actions :playlist="$podcast" wire:key="podcast-teaser-actions-{{ $podcast->id }}" />
            </div>
        </div>
        <div class="py-2 w-75">
            <h5 class="podcast-title"><a  href="{{route('podcast', ['podcast' => $podcast->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($podcast->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
            <p class="fs-6 overflow-hidden text-truncate text-nowrap">
                {!! $podcast->translate(App::getLocale(), true)->description !!}
            </p>
        </div>
    </div>

</div>
