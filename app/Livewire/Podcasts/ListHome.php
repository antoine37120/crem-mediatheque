<?php

namespace App\Livewire\Podcasts;

use Livewire\Component;
use App\Models\Playlist;


class ListHomePodcasts extends Component
{
    public $podcasts = [];

    public $podcast = '';

    public function mount()
    {
        $this->podcasts = Playlist::select('*')->inRandomOrder()->take(4)->get();
    }

    public function render()
    {
        return view('livewire.podcasts.list-home');
    }
}
