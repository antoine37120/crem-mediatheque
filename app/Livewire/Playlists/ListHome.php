<?php

namespace App\Livewire\Playlists;

use Livewire\Component;
use App\Models\Playlist;

class ListHome extends Component
{
    public $playlists = [];

    public $playlist = '';

    public function mount()
    {
        // $this->playlists = Playlist::select('*')->inRandomOrder()->take(4)->get();
        $this->playlists = Playlist::select('*')->where('published', 1)->where('type_id', 1)->inRandomOrder()->take(4)->get();
    }

    public function render()
    {
        return view('livewire.playlists.list-home');
    }
}

