<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;
use Illuminate\Support\Facades\Log;

class FullTrack extends Component
{
    public $track;

    public function mount(AudioItem $track)
    {
        $this->track = $track;
 
        $this->fill( 
            $track->only('name', 'description', 'picture'), 
        ); 
    }
    public function render()
    {
        return view('livewire.tracks.full-track');
    }
}
