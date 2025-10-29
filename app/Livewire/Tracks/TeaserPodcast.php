<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;

class TeaserPodcast extends Component
{
    public $track;
    public $podcast_id;

    public function mount(AudioItem $track, $podcast)
    {
        $this->track = $track;
        $this->podcast_id = $podcast;

        $this->fill(
            $track->only('name', 'description', 'picture'),
        );
    }
    public function render()
    {
        return view('livewire.tracks.teaser-podcast');
    }
}
