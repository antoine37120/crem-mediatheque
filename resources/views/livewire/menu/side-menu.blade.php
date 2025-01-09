<div>
    <div class="p-2">
        <div class="text-center my-4">
            <div class="h-20" style="max-width: 200px">
                <div>
                    <img src="/storage/logos/logo-musicoologieVOK.jpg" alt="" class="py-3 mw-100"></img>
                </div>
                {{-- <div style="max-width: 150px">
                    <svg xmlns="/storage/app/public/logos/logo-musicoologieVOK.svg" height="20vh" class="" viewBox="0 0 100 100"></svg>
                </div> --}}
            </div>
        </div>
        <hr class="border-top border-dark my-3"/>
        <div id="global-search-form" class="">
            <form  wire:submit="searchLauch">
            <div class="input-group border border-dark rounded-pill mt-4 mb-4">
                <input type="hidden" name="year" wire:model.live="query_year">
                <input type="hidden" name="geoArea" wire:model.live="query_geoArea">
                <input type="hidden" name="duration" wire:model.live="query_duration">
                <input type="text" class="form-control border-end-0" placeholder="" aria-label="Search" aria-describedby="basic-addon2" wire:model="search">
                <button type="submit" class="btn bg-white" id="basic-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
            </form>
        </div>
        <ul class="list-unstyled fs-5 d-grid gap-3 my-4 ms-3">
            <li><a href="{{route('home')}}" class="text-black text-decoration-none" wire:navigate>{{ __('menu.home') }}</a></li>
            <li><a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>Tracks</a></li>
            <li><a href="{{route('playlists')}}" class="text-black text-decoration-none" wire:navigate>Playlists</a></li>
            <li><a href="{{route('podcasts')}}" class="text-black text-decoration-none" wire:navigate>Podcasts</a></li>
            <li><a href="{{route('cmsPage', ['cmsPage' => 'about']) }}" class="text-black text-decoration-none" wire:navigate>A propos</a></li>
        </ul>
    </div>

    <livewire:menu.logos-partners />
</div>

