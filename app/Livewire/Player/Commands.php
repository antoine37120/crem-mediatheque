<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\Session;

class Commands extends Component
{
    #[Session(key: 'playlist_play_id')] 
    public $item_play = 'none';
    public function render()
    {
        return view('livewire.player.commands');
    }
}
