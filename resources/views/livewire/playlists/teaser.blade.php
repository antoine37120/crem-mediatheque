<div>
    <div class="card-track d-flex flex-column bg-transparent position-relative">
        <div class="justify-content-between flex-shrink-1 flex-nowrap mx-0">
            <div class="position-relative p-0 w-75 max-w-img-card-list" style="">
                <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..."
                     style="background: {{ $playlist->randomColor() }};" width="150" height="150"
                     href="{{route('playlist', ['playlist' => $playlist->id])}}" role="button"
                     wire:navigate
                />
                <div class="card-playlist-actions position-absolute top-0 end-0 p-1">
                    <livewire:playlists.list-self-actions :playlist="$playlist" wire:key="playlist-teaser-actions-{{ $playlist->id }}" />
                </div>
            </div>
            <div class="py-2">
                {{-- w-75 --}}
                <h5 class="m-0">
                    <a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>
                        {{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
                <p class="fs-6">
                    {!! $playlist->translate(App::getLocale(), true)->description !!}
                </p>
            </div>
        </div>
    </div>

</div>
