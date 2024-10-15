{{-- desktop --}}
<div>
    <div class="p-2">
        {{-- <ul>
            <li> "{{ $menuItem }}" </li>
        </ul> --}}
        <ul class="list-unstyled fs-2 d-grid gap-3">
            <li><a href="{{route('home')}}" wire:navigate>Accueil</a></li>
            <li><a href="{{route('tracks')}}" wire:navigate>Tracks</a></li>
            <li>Playlists</li>
            <li>Podcasts</li>
            <li>About</li>
        </ul>
    </div>
    {{-- Success is as dangerous as failure. --}}

    <livewire:menu.logos-partners />
</div>

