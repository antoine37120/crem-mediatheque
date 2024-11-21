<div>
        {{-- page liste des playlists --}}
        @foreach ($playlists as $playlist)
        <div class="container my-4">
            <div class="row align-items-start my-2 g-5">
                <div class="col-2">
                    <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
                </div>
                <div class="d-none d-md-block col-md-1">
                </div>
                <div class="col-12 col-md-9">
                    <h5 class="card-title"><a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
                <p>{{ $playlist->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
</div>
