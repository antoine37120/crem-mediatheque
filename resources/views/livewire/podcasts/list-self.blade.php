<div>
    {{-- page liste des podcasts --}}

    @foreach ($podcasts as $podcast)
    <div class="podcasts-list-self my-4 mx-0 px-2">
        <div class="row flex-nowrap align-items-start m-0 my-0 gy-5">
            <div class="col-3 position-relative p-0 ps-0 mt-0 m-0">
                <div class="position-relative p-0 col-11 col-md-9 max-w-img-card-list">
                    <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..."/>
                    <div class="card-playlist-actions position-absolute top-0 end-0 p-1 d-none d-md-block">
                        <livewire:playlists.list-self-actions :playlist="$podcast" wire:key="podcast-list-self-actions-{{ $podcast->id }}" />
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-9 mt-0 px-0">
                <h5 class="card-title"><a  href="{{route('podcast', ['podcast' => $podcast->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($podcast->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
                <p>{!! $podcast->translate(App::getLocale(), true)->description !!}</p>
            </div>
            <div class="col-3 d-block d-md-none text-right ps-0 pe-0 m-0">
                <livewire:playlists.list-self-actions :playlist="$podcast" wire:key="podcast-list-self-actions-mobile-{{ $podcast->id }}" />
            </div>
        </div>
    </div>
    @endforeach
</div>
