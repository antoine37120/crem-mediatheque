<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\Session;
use App\Models\AudioItem;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class Tracklist extends Component
{
    #[Session(key: 'playlist_items_ids')] 
    public $items_ids = [];

    #[Session(key: 'playlist_play_id')] 
    public $item_play = 'none';

    public $playlist_items = [] ;
    

    #[On('play-track-to-playlist')] 
    public function updateTrackPlay($id)
    {
        Log::debug('Trigger play') ;
        Log::debug($id) ;
        $this->item_play = $id ;
    }

    #[On('add-track-to-playlist')] 
    public function updateTrackList($id)
    {
        Log::debug($id) ;
        $this->items_ids[] = $id ;
        $this->playlist_items() ;
    }
    #[On('delete-to-playlist')] 
    public function deleteToTrackList($id)
    {

        $array = [];
        foreach ($this->items_ids as $key => $value) {
            if ($value != $id) {
                $array[] = $value;
            }
        }
        $this->items_ids = $array ;
 
        $this->playlist_items() ;
    }

    protected function playlist_items()
    {
        if ( $this->items_ids === []) {
            $this->playlist_items = [] ;
        } else {
            $this->playlist_items = AudioItem::whereIn('id', $this->items_ids)->get();
        }
    }

  
    public function mount()
    {
        if($this->item_play == '') {
            $this->item_play = 'none' ;
        }
        Log::debug($this->items_ids) ;
        Log::debug($this->item_play) ;
        $this->playlist_items() ;
        
        Log::debug($this->playlist_items) ;
    }


    public function render()
    {
        return view('livewire.player.tracklist');
    }
}
