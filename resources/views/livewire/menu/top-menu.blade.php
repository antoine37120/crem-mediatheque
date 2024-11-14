{{-- mobile --}}
<div>
    <div class="row fixed-top p-4 d-flex justify-center">
        <div class="col-4 text-center">
            <button type="button" class="btn w-100 bg-secondary rounded-pill"><a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>Tracks</a></button>
        </div>
        <div class="col-4 text-center">
            <button type="button" class="btn w-100 bg-secondary rounded-pill"><a href="{{route('playlists')}}" class="text-black text-decoration-none" wire:navigate>Playlists</a></button>
        </div>
        <div class="col-4 text-center">
            <button type="button" class="btn w-100 bg-secondary rounded-pill"><a href="{{route('podcasts')}}" class="text-black text-decoration-none" wire:navigate>Podcasts</a></button>
        </div>
    </div>
</div>
