<?php

namespace App\Livewire\Podcasts;

use Livewire\Component;
use App\Models\Playlist;

class Teaser extends Component
{
    public $podcast;

    public function mount(Playlist $playlist)
    {
        $this->podcast = $playlist;

        $this->fill(
            $playlist->only('name', 'description', 'picture'),
        );
    }
    public function render()
    {
        return view('livewire.podcasts.teaser');
    }
}
