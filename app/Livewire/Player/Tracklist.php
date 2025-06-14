<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\Session;
use App\Models\AudioItem;
use App\Models\AudioItemPlaylist;
use App\Models\Playlist;
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
        $this->item_play = $id ;
    }

    #[On('add-search-to-playlist')]
    public function updateTrackListWithSearch()
    {
        $audioItems = $this->track_nav_data ;
        $i = 0 ;
        foreach($audioItems as $item){
            $this->updateTrackList($item) ;
            $i++;
        }
        $this->notice_add_search($i);
    }

    #[On('add-search-to-playlist-random')]
    public function updateTrackListWithSearchRandom()
    {
        $audioItems = Arr::shuffle($this->track_nav_data) ;
        $i = 0;
        foreach($audioItems as $item){
            $this->updateTrackList($item) ;
            $i++;
        }
        $this->notice_add_search($i);
    }

    public function notice_add_search($count) {
        $notice_text = __('notifications.add_to_search', ['count' => $count]);
        $notice_color = 'search' ;
        $this->dispatch('add_notice_user', text: $notice_text, color: $notice_color);
    }

    #[On('add-playlist-to-playlist')]
    public function updateTrackListWithPlaylist($id)
    {
        $audioItems = AudioItemPlaylist::getPublishedAudioItemsForPlaylist($id);
        $i = 0;
        foreach($audioItems as $item){
            if (!in_array( $item->id, $this->items_ids)) {
                $this->items_ids [] = $item->id;
                $i++;
            }
        }
        if($i > 0) {
            $this->playlist_items( true) ;
            $this->notice_add_playlist($id, $i);
        } else {
            $this->notice_exist_playlist($id);
        }
    }

    #[On('add-playlist-to-playlist-clear')]
    public function updateTrackListWithPlaylistClear($id)
    {

        $this->items_ids = [];
        $audioItems = AudioItemPlaylist::getPublishedAudioItemsForPlaylist($id);
        $i = 0;
        foreach($audioItems as $item){
            if ($i == 0) {
                $this->item_play = $item->id ;
            }
            $this->items_ids [] = $item->id;
            $i++;
        }

        $this->playlist_items( true) ;
        $this->dispatch('playlist-plaiyed-item-deleted');
        $this->dispatch('launch_play', trackToPlay: $this->item_play);
        $this->notice_add_playlist($id, $i);

    }


    public function notice_add_playlist($id, $count) {

        $playlist = Playlist::find($id) ;

        $notice_color = 'playlist' ;
        if($playlist->type->name == 'Podcast') {
            $notice_color = 'podcast' ;
        }
        $notice_text = __('notifications.add_playlist', ['count' => $count, 'playlist' => $playlist->translate(app()->getLocale(), true)->name]);
        $this->dispatch('add_notice_user', text: $notice_text, color: $notice_color);
    }

    public function notice_exist_playlist($id) {

        $playlist = Playlist::find($id) ;

        $notice_color = 'playlist' ;
        if($playlist->type->name == 'Podcast') {
            $notice_color = 'podcast' ;
        }
        $notice_text = __('notifications.exist_on_playlist', ['playlist' => $playlist->translate(app()->getLocale(), true)->name]);
        $this->dispatch('add_notice_user', text: $notice_text, color: $notice_color);
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
        $track = AudioItem::find($id);
        $notice_text = __('notifications.add_track_to_playlist', ['track' => $track->translate(app()->getLocale(), true)->name]);
        $notice_color = str_replace('#', '', $track->getHexaColor()) ;
        $this->dispatch('add_notice_user', text: $notice_text, color: $notice_color);

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
     * Triggered when a track is added to the playlist.
     *
     * @param int $id The id of the track to add.
     *
     * The added track is added to the playlist items and the event 'playlist-items-list-refresh' is dispatched.
     * The 'playlist_items' property is then refreshed.
     */
    #[On('reset-play-track-to-playlist')]
    public function resetPlayTrackList($id)
    {
        $this->items_ids = [];


        $this->item_play = $id;
        Log::debug($id) ;
        if (!in_array($id, $this->items_ids)) {
            $this->items_ids [] = $id ;
            $this->playlist_items(true) ;
        }

        $this->dispatch('playlist-plaiyed-item-deleted');
        $this->dispatch('launch_play', trackToPlay: $id);

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
