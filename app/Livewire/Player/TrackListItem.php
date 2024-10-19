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
    #[Session(key: 'playlist_play_id')] 
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
    
    
    public function render()
    {
        return view('livewire.player.track-list-item');
    }
}
