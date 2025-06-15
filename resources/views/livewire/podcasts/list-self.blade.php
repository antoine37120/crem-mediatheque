<div>
    {{-- page liste des podcasts --}}

    @foreach ($podcasts as $podcast)
    <div class="container podcasts-list-self my-4">
        <div class="row flex-nowrap align-items-start my-2 gy-5">
            <div  class="col-auto position-relative p-0 ps-2 mt-2">
                <div class="position-relative d-inline-block p-0 m-0">
                    <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
                    <div class="card-playlist-actions position-absolute top-0 end-0 p-1">
                        <livewire:playlists.list-self-actions :playlist="$podcast" wire:key="podcast-list-self-actions-{{ $podcast->id }}" />
                    </div>
                </div>
            </div>
            <div class="col-auto mt-2">
                <h5 class="card-title"><a  href="{{route('podcast', ['podcast' => $podcast->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($podcast->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
                <p>{!! $podcast->translate(App::getLocale(), true)->description !!}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
