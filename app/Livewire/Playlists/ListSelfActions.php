<?php

namespace App\Livewire\Playlists;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\AudioItemPlaylist;
class ListSelfActions extends Component
{
    public $playlist;
    public $audioItems;
    public $randomAudioItems;

    public function mount(Playlist $playlist)
    {
        $this->playlist = $playlist;

        $this->fill(
            $playlist->only('name', 'description', 'picture'),
        );
        //$audioItems = AudioItemPlaylist::where('playlist_id', $this->playlist->id)->get();

        $allItems = [];
        $this->audioItems = $allItems;

        $allItems = [];

        $this->randomAudioItems = $allItems;


    }
    public function render()
    {
        return view('livewire.playlists.list-self-actions');
    }
}
