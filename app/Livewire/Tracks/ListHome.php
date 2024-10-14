<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;

class ListHome extends Component
{
    public $tracks = [];
 
    public $track = '';
 
    public function mount()
    {
        $this->tracks = AudioItem::all()->take(4); 
    }
    public function render()
    {
        return view('livewire.tracks.list-home');
    }
}
