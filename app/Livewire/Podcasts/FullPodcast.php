<?php

namespace App\Livewire\Podcasts;

use Livewire\Component;
use App\Models\Playlist;

class FullPodcast extends Component
{
    public $podcast;

    public function mount(Playlist $podcast)
    {
        $this->podcast = $podcast;

        $this->fill(
            $podcast->only('name', 'description', 'picture'),
        );
    }
    public function render()
    {
        return view('livewire.podcasts.full-podcast');
    }
}
