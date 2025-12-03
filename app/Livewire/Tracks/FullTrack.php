<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;
use App\Models\Playlist;
use Illuminate\Support\Facades\Log;

class FullTrack extends Component
{
    public $track;
    public $playlist = null;
    public $playlist_type = '';

    public function mount(AudioItem $track, $playlist_id=null)
    {
        
        $this->track = $track;
        $this->playlist = Playlist::find($playlist_id);
        if($this->playlist) {
            $this->playlist_type = $this->playlist->type->name;
        }

        $this->fill(
            $track->only('name', 'description', 'picture'),
        );
    }
    public function render()
    {
        return view('livewire.tracks.full-track');
    }
}
