<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;

class SectionTitle extends Component
{
    public $track;
    public $playlist_id;

    public function mount(AudioItem $track, $playlist_id)
    {
        $this->track = $track;
        $this->playlist_id = $playlist_id;

        $this->fill(
            $track->only('name', 'description', 'picture'),
        );
    }
    public function render()
    {
        return view('livewire.tracks.section-title');
    }
}
