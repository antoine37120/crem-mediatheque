<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;

class ListSelf extends Component
{
    public $tracks = [];

    public $track = '';

    public function mount()
    {
        $this->tracks = AudioItem::all();
    }
    public function render()
    {
        return view('livewire.tracks.list-self');
    }
}
