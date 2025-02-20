{{-- mobile --}}
<div>
    <div class="row top-menu fixed-top p-4 d-flex justify-center">
        <div class="col-4 text-center">
            <button type="button" class="btn w-100 rounded-pill border border-black"><a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>{{ __('menu.tracks') }}</a></button>
        </div>
        <div class="col-4 text-center">
            <button type="button" class="btn w-100 rounded-pill border border-black"><a href="{{route('playlists')}}" class="text-black text-decoration-none" wire:navigate>{{ __('menu.playlists') }}</a></button>
        </div>
        <div class="col-4 text-center">
            <button type="button" class="btn w-100 rounded-pill border border-black"><a href="{{route('podcasts')}}" class="text-black text-decoration-none" wire:navigate>{{ __('menu.podcasts') }}</a></button>
        </div>
    </div>
</div>
