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
        $this->tracks = AudioItem::select('*')->inRandomOrder()->take(4)->get(); 
    }
    public function render()
    {
        return view('livewire.tracks.list-home');
    }
}
