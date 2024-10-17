<?php

namespace App\Livewire\Podcasts;
use App\Models\Playlist;

use Livewire\Component;

class FullEpisode extends Component
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
        return view('livewire.podcasts.full-episode');
    }
}
