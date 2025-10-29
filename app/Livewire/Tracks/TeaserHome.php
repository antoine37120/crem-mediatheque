<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;

class TeaserHome extends Component
{
    public $track;
    public $displayMode = false;

    public function mount(AudioItem $track, $displayMode = false)
    {
        $this->track = $track;
        $this->displayMode = $displayMode;

        $this->fill(
            $track->only('name', 'description', 'picture'),
        );
    }

    public function render()
    {
        return view('livewire.tracks.teaser-home');
    }
}
