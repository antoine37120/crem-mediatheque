<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\AudioItem;
use Livewire\Attributes\Session;

class TrackListItem extends Component
{
    public $track;
    public $it;
    public $selected = 'none';

    public function mount(AudioItem $track, $it, $selected)
    {
        $this->track = $track;
        $this->it = $it;
        $this->selected = $selected;
 
        $this->fill( 
            $track->only('name', 'description', 'picture'), 
        ); 
    }

    #[On('play-track-to-playlist')]
    public function updateTrackPlay($id)
    {
        $this->selected = $id;
    }
    
    
    public function render()
    {
        return view('livewire.player.track-list-item');
    }
}
