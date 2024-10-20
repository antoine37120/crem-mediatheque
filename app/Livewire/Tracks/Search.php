<?php

namespace App\Livewire\Tracks;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\AudioItem;
use App\Models\AudioItemTranslation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class Search extends Component
{
    public $tracks = [];

    #[Url(as: 'q')]
    public $search = '';

    public $years = [];

    public function mount()
    {

        $this->tracks = [] ;
        //$this->search = request()->search ;
        if ($this->search != '') {
            
            $trans_tracks = AudioItemTranslation::search($this->search)
            ->query(function ($query) {
                $query->join('audio_items', 'audio_item_translations.audio_item_id', 'audio_items.id')
                    ->select(['audio_item_translations.id', 'audio_items.id as audio_item',])
                    ->where('audio_items.year', '>=', 0)
                    ->orderBy('audio_item_translations.id', 'DESC');
            })->get() ;

            foreach ( $trans_tracks as $track) {
                $this->tracks[] = AudioItem::find($track->audio_item) ;
            }
        } else {
            $this->tracks = AudioItem::all();
        }
    }
    public function render()
    {
        return view('livewire.tracks.search');
    }
}
