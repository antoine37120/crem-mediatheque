<?php

namespace App\Livewire\Playlists;

use Livewire\Component;
use App\Models\Playlist;

class Teaser extends Component
{
    public $playlist;

    public function mount(Playlist $playlist)
    {
        $this->playlist = $playlist;

        $this->fill(
            $playlist->only('name', 'description', 'picture'),
        );
    }
    public function render()
    {
        return view('livewire.playlists.teaser');
    }
}
