<div>
        {{-- page liste des playlists --}}

        @foreach ($playlists as $playlist)
        <div class="container playlists-list-self my-4">
            <div class="row flex-nowrap align-items-start my-2 gy-5">
                <div class="col-2 position-relative p-0 ps-2 mt-2 offset-lg-1">
                    {{-- style="width: fit-content" --}}
                    <div class="position-relative d-inline-block p-0 m-0">
                        <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
                        <div class="card-playlist-actions position-absolute top-0 end-0 p-1">
                            <livewire:playlists.list-self-actions :playlist="$playlist" wire:key="playlist-list-self-actions-{{ $playlist->id }}" />
                        </div>
                    </div>
                </div>
                <div class="col-10 col-md-9 mt-2 offset-1">
                    <h5 class="card-title"><a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
                    <p>{!! $playlist->translate(App::getLocale(), true)->description !!}</p>
                </div>
            </div>
        </div>
        @endforeach
</div>
