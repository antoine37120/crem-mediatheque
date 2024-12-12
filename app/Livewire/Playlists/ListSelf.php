<?php

namespace App\Livewire\Playlists;

use Livewire\Component;
use App\Models\Playlist;

class ListSelf extends Component
{
    public $playlists = [];

    public $playlist = '';

    public function mount()
    {
        $this->playlists = Playlist::all()->where('type_id', 1)->where('published', 1);
    }
    public function render()
    {
        return view('livewire.playlists.list-self');
    }
}
