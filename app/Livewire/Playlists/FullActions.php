<?php

namespace App\Livewire\Playlists;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\AudioItemPlaylist;

class FullActions extends Component
{
    public $playlist;
    public $audioItems;
    public $randomAudioItems;

    public function mount(Playlist $playlist)
    {
        $this->playlist = $playlist;

        $this->fill(
            $playlist->only('name', 'description', 'picture'),
        );
        //$audioItems = AudioItemPlaylist::where('playlist_id', $this->playlist->id)->get();

        $allItems = [];

        /*foreach($audioItems as $item){
            $array = [
                'id' => $item->audio_item_id,
                'title' => $item->audio_item->translate(app()->getLocale(), true)->name,
                'fileUrl' => url('storage/'.$item->audio_item->file),
                'zone' => $item->audio_item->geographicalArea->translate(app()->getLocale(), true)->name,
                'year' => $item->audio_item->year,
                'time' => $item->audio_item->duration
            ];  
            $allItems[] = $array;

        }*/
        //convert allItems to json and assign it to audioItems property
        $this->audioItems = $allItems;

        
        //$audioItems = AudioItemPlaylist::where('playlist_id', $this->playlist->id)->inRandomOrder()->get();
        $allItems = [];

        /*foreach($audioItems as $item){
            $array = [
                'id' => $item->audio_item_id,
                'title' => $item->audio_item->translate(app()->getLocale(), true)->name,
                'fileUrl' => url('storage/'.$item->audio_item->file),
                'zone' => $item->audio_item->geographicalArea->translate(app()->getLocale(), true)->name,
                'year' => $item->audio_item->year,
                'time' => $item->audio_item->duration
            ];  
            $allItems[] = $array;

        }*/
        //convert allItems to json and assign it to audioItems property
        $this->randomAudioItems = $allItems;


    }

    public function render()
    {
        return view('livewire.playlists.full-actions');
    }
}
