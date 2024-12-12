<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\Session;
use App\Models\AudioItem;
use App\Models\AudioItemPlaylist;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Filament\Notifications\Notification;

class Tracklist extends Component
{
    #[Session(key: 'playlist_items_ids')] 
    public $items_ids = [];

    #[Session(key: 'playlist_play_id')] 
    public $item_play = 'none';

    #[Session(key: 'track_nav_data')] 
    public $track_nav_data = [];

    public $playlist_items = [] ;

    public $start_play_id = 0 ;
    

    #[On('reordering-playlist')] 
    public function reorderTrackList($ids)
    {
        Log::debug('Trigger play') ;
        Log::debug($ids) ;
        $this->items_ids = $ids;
        $this->playlist_items() ;

    }
    /**
     * Triggered when a track is played from the playlist.
     *
     * @param int $id The id of the track to play.
     *
     * The session item_play is set to the given track id.
     */
    #[On('play-track-to-playlist')] 
    public function updateTrackPlay($id)
    {
        Log::debug('Trigger play') ;
        Log::debug($id) ;
        $this->item_play = $id ;

    }

    #[On('add-search-to-playlist')] 
    public function updateTrackListWithSearch()
    {
        $audioItems = $this->track_nav_data ;
        foreach($audioItems as $item){
            $this->updateTrackList($item) ;
        } 
    }

    #[On('add-search-to-playlist-random')] 
    public function updateTrackListWithSearchRandom()
    {
        
        $audioItems = Arr::shuffle($this->track_nav_data) ;
        foreach($audioItems as $item){
            $this->updateTrackList($item) ;
        } 
        
    }

    #[On('add-playlist-to-playlist')] 
    public function updateTrackListWithPlaylist($id)
    {
        Log::debug($id) ;
        $audioItems = AudioItemPlaylist::where('playlist_id', $id)->get();
        foreach($audioItems as $item){
            $this->updateTrackList($item->audio_item->id) ;
        } 
    }

    #[On('add-playlist-to-playlist-random')] 
    public function updateTrackListWithPlaylistRandom($id)
    {
        Log::debug($id) ;
        $audioItems = AudioItemPlaylist::where('playlist_id', $id)->inRandomOrder()->get();
        foreach($audioItems as $item){
            $this->updateTrackList($item->audio_item->id) ;
        } 
        
    }
    /**
     * Triggered when a track is added to the playlist.
     *
     * @param int $id The id of the track to add.
     *
     * The added track is added to the playlist items and the event 'playlist-items-list-refresh' is dispatched.
     * The 'playlist_items' property is then refreshed.
     */
    #[On('add-track-to-playlist')] 
    public function updateTrackList($id)
    {
        Log::debug($id) ;
        if (!in_array($id, $this->items_ids)) {
            $this->items_ids [] = $id ;
            $this->playlist_items() ;
        } 
        
    }
    /**
     * Triggered when a track is deleted from the playlist.
     *
     * @param int $id The id of the track to delete.
     *
     * If the deleted track is the current track played, the played track is set to none and the event 'playlist-plaiyed-item-deleted' is dispatched.
     * The deleted track is then removed from the playlist items.
     * Finally, the playlist items are refreshed.
     */
    #[On('delete-to-playlist')] 
    public function deleteToTrackList($id)
    {
        if($this->item_play == $id) {
            
            $this->item_play = 'none';
            $this->dispatch('playlist-plaiyed-item-deleted');
        }
        $array = [];
        foreach ($this->items_ids as $key => $value) {
            if ($value != $id) {
                $array[] = $value;
            }
        }
        $this->items_ids = $array ;
 
        $this->playlist_items() ;
    }

    /**
     * Updates the playlist_items session variable by querying the database
     * with the current items_ids session variable.
     * 
     * @param bool $dispatchRefresh Whether to dispatch the 
     * 'playlist-items-list-refresh' event after updating the session variable.
     * 
     * @return void
     */

    protected function playlist_items($dispatchRefresh = true)
    {
        if ( $this->items_ids === []) {
            $this->playlist_items = [] ;
        } else {
            $this->playlist_items = [] ;
            $playlist_items = AudioItem::whereIn('id', $this->items_ids)->get();
            $collection = $playlist_items->keyBy('id');
            foreach ($this->items_ids as $key => $value) {
                if(AudioItem::find($value) != null) {
                    $this->playlist_items [] = $collection->get($value);
                } else {
                    //need to delete old item from session
                    unset($this->items_ids[$key]) ;
                }
            }

        }
        if(sizeof($this->playlist_items) == 1) {
            $this->item_play = $this->playlist_items[0]->id ;
            $this->start_play_id = $this->playlist_items[0]->id ;
        }
        //$this->render() ;
        if ($dispatchRefresh) {
            $this->dispatch('playlist-items-list-refresh');
        }
    }

  

    public function mount()
    {
        if($this->item_play == '') {
            $this->item_play = 'none' ;
        }
        if(AudioItem::find($this->item_play) == null) {
            $this->item_play = 'none' ;
        }
        //Log::debug($this->items_ids) ;
        //Log::debug($this->item_play) ;
        $this->playlist_items(false) ; // dont need refresh on init process

        $this->start_play_id = $this->item_play ;
        
        //Log::debug($this->playlist_items) ;
    }


    public function render()
    {
        return view('livewire.player.tracklist');
    }
}
