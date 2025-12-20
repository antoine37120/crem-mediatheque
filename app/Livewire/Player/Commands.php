<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\On;

class Commands extends Component
{
    public $item_play = 'none';

    #[On('play-track-to-playlist')]
    public function updateTrackPlay($id)
    {
        $this->item_play = $id;
    }

    public function render()
    {
        return view('livewire.player.commands');
    }
}
