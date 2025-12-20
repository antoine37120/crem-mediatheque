<?php

namespace App\Livewire\Playlists;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\AudioItemPlaylist;
use Livewire\Attributes\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FullPlaylist extends Component
{
    public $playlist;
    
    public $track_nav_mode = '';
    
    public $track_nav_data = [];

    public function mount(Playlist $playlist)
    {
        $this->playlist = $playlist;

        $this->fill(
            $playlist->only('name', 'description', 'picture'),
        );

        $this->track_nav_mode = 'playlist';

        $this->track_nav_data = DB::table('audio_item_playlists')
                    ->join('audio_items', 'audio_item_playlists.audio_item_id', 'audio_items.id')
                    ->where('audio_items.published', 1)
                    ->where('playlist_id', $this->playlist->id)
                    ->orderBy('sort', 'asc')
                    ->pluck('audio_item_id')->toArray();

        $this->dispatch('update-nav-data', mode: $this->track_nav_mode, data: $this->track_nav_data);
    }
    public function render()
    {
        return view('livewire.playlists.full-playlist');
    }
}
