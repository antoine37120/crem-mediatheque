<?php

namespace App\Livewire\Podcasts;

use Livewire\Component;
use App\Models\Playlist;

class ListSelf extends Component
{
    public $podcasts = [];

    public $podcast = '';

    public function mount()
    {
        $this->podcasts = Playlist::all()->where('type_id', 2)->where('published', 1);
    }
    public function render()
    {
        return view('livewire.podcasts.list-self');
    }
}
