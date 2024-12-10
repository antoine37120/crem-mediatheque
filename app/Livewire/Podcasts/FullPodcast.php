<?php

namespace App\Livewire\Podcasts;

use Livewire\Component;
use App\Models\Playlist;
use Livewire\Attributes\Session;
use Illuminate\Support\Facades\DB;

class FullPodcast extends Component
{
    public $podcast;
    
    #[Session(key: 'track_nav_mode')] 
    public $track_nav_mode = '';
    
    #[Session(key: 'track_nav_data')] 
    public $track_nav_data = [];

    public function mount(Playlist $podcast)
    {
        $this->podcast = $podcast;

        $this->fill(
            $podcast->only('name', 'description', 'picture'),
        );

        $this->track_nav_mode = 'playlist';

        $this->track_nav_data = DB::table('audio_item_playlists')
                    ->where('playlist_id', $this->podcast->id)
                    ->orderBy('sort', 'asc')
                    ->pluck('audio_item_id')->toArray();
    }
    public function render()
    {
        return view('livewire.podcasts.full-podcast');
    }
}
