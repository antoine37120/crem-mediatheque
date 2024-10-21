<div>
        {{-- page liste des playlists --}}

        <div class="container my-4">
            @foreach ($playlists as $playlist)

            <div class="row align-items-start my-2 g-5">
                <div class="col-2 px-5">
                    <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
                </div>
                <div class="col-10">
                    <h5 class="card-title"><a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
                <p>{{ $playlist->description }}</p>
                </div>
            </div>
            <div class="row align-items-start my-2 g-5">
                <div class="col-2 px-5">
                    <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..."/>
                </div>
                <div class="col-10">
                    <h5>Titre playlist 2</h5>
                    <p>Descriptif playlist: Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam quae cum inventore praesentium minus dignissimos eum impedit ducimus iste illum dolor, mollitia reprehenderit quod enim nam optio amet provident iure.</p>
                </div>
            </div>
        </div>
        @endforeach
</div>
