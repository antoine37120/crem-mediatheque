<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use App\Models\AudioItem;
use App\Models\AudioItemPlaylist;
use Livewire\Attributes\Session;
use Illuminate\Support\Facades\DB;

class SectionTitle extends Component
{
    public $track;
    
    #[Session(key: 'track_nav_mode')] 
    public $track_nav_mode = '';
    
    #[Session(key: 'track_nav_data')] 
    public $track_nav_data = [];

    public $prev_id ;
    public $next_id ;

    public function mount(AudioItem $track)
    {
        $this->track = $track;



        $this->fill(
            $track->only('name', 'description', 'picture'),
        );

        
        if(!in_array($this->track->id, $this->track_nav_data)) {

            $playlist = AudioItemPlaylist::where('audio_item_id ', $this->track->id)->first() ;

            
            $this->track_nav_data = DB::table('audio_item_playlists')
                ->where('playlist_id', $playlist->id)
                ->orderBy('sort', 'asc')
                ->pluck('audio_item_id');
        }


        if($this->track_nav_mode != '') {
            $collection = collect($this->track_nav_data);

            $this->prev_id = $collection->before($this->track->id); // If null, can be the first on array
            $this->next_id = $collection->after($this->track->id); // if null can be the last on array

            // If audio item is on the first position, prev id should be the last item in the collection
            if( $this->prev_id == null) {
                $this->prev_id = $collection->last() ;
            }
            // If audio item is on the last position, next id should be the first item in the collection
            if( $this->next_id == null) {
                $this->next_id = $collection->first() ;
            }

        }

    }
    public function render()
    {
        return view('livewire.tracks.section-title');
    }
}
