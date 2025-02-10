<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;
use App\Models\AudioItemPlaylist;



class SectionPlaylists extends Component

{
    public $track;
    public $playlists = [];
    public $podcasts = [];

    public function mount(AudioItem $track)
    {
        $this->track = $track;
 
        $this->fill( 
            $track->only('name', 'description', 'picture'), 
        ); 
        $ai_playlists = AudioItemPlaylist::where('audio_item_id', $this->track->id)->get();
        foreach($ai_playlists as $ai_playlist) {
            $playlist = $ai_playlist->playlist ;
            if($playlist->published) {
                if($playlist->type->name == 'Podcast' ) {
                    $this->podcasts[] = $playlist ;
                } else {
                    $this->playlists[] = $playlist ;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.tracks.section-playlists');
    }
}
