<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\AudioItem;

class TrackTitle extends Component
{    
    public $track;

    public function mount($id)
    {
        if ($id != 'none') {
            $this->track = AudioItem::findOrFail($id);
        } else {
            $this->track = 'none';
        }
 

    }
    
    
    /**
    * Triggered when a track is played from the playlist.
    *
    * @param int $id The id of the track to play.
    *
    * The session item_play is set to the given track id.
    */
   #[On('play-track-to-playlist')] 
   public function updateTrackPlay($id)
   {
    
    if ($id !=  $this->track->id) {
        $this->track = AudioItem::findOrFail($id);
    }
    
   }
    public function render()
    {
        return view('livewire.player.track-title');
    }
}
