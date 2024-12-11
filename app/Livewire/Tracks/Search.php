<?php

namespace App\Livewire\Tracks;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\AudioItem;
use App\Models\AudioItemTranslation;
use App\Models\GeographicalArea;
use App\Models\DurationOption;
use App\Models\YearOption;
use \Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Session;


class Search extends Component
{
    public $tracks = [];

    #[Url(as: 'q')]
    public $search = '';

    #[Url(as: 'year')]
    public $query_year = '';

    #[Url(as: 'geoArea')]
    public $query_geoArea = '';

    #[Url(as: 'duration')]
    public $query_duration = '';

    public $geoAreas = [];
    public $years = [];
    public $durations = [];

    
    #[Session(key: 'track_nav_mode')] 
    public $track_nav_mode = '';
    
    #[Session(key: 'track_nav_data')] 
    public $track_nav_data = [];

    public function loadSelectOtpions() {

        $this->geoAreas = GeographicalArea::orderBy('region_code')->get();
        $this->years = YearOption::orderBy('from', 'asc')->get();
        $this->durations = DurationOption::orderBy('from', 'asc')->get();   
    }

    public function playSearch()
    {
        $this->tracks = [] ;
        /*Log::info('$this->query_year') ;
        Log::info($this->query_year) ;
        Log::info('$this->query_geoArea') ;
        Log::info($this->query_geoArea) ;
        Log::info('$this->query_duration') ;
        Log::info($this->query_duration) ;*/
        /*Log::info('$this->track_nav_mode') ;
        Log::info($this->track_nav_mode) ;
        Log::info('$this->track_nav_data') ;
        Log::info($this->track_nav_data) ;*/

        $this->dispatch('search-facets-change', year:$this->query_year, geoArea: $this->query_geoArea, 
            duration:$this->query_duration
        );

        //$this->search = request()->search ;
        //if ($this->search != '') {
            
            $trans_tracks = AudioItemTranslation::search($this->search)->where('locale', App::getLocale())
            ->query(function ($query) {
                $query->join('audio_items', 'audio_item_translations.audio_item_id', 'audio_items.id')
                    ->select(['audio_item_translations.id', 'audio_items.id as audio_item',])
                    ->where('audio_items.year', '>=', 0)
                    ->orderBy('audio_item_translations.id', 'DESC');
                    if($this->query_year != '') {
                        $year_option = YearOption::find($this->query_year) ;
                        if ($year_option->from !=null) {
                            $query->where('audio_items.year', '>=', $year_option->from);
                        }
                        if ($year_option->to !=null) {
                            $query->where('audio_items.year', '<', $year_option->to);
                        }
                    }
                    if($this->query_duration != '') {
                        $duration_option = DurationOption::find($this->query_duration) ;
                        if ($duration_option->from !=null) {
                            $query->where('audio_items.duration', '>=', $duration_option->from);
                        }
                        if ($duration_option->to !=null) {
                            $query->where('audio_items.duration', '<', $duration_option->to);
                        }
                    }

                    if($this->query_geoArea != '') {
                        $query->where('audio_items.geographical_area_id', $this->query_geoArea);
                    }

            })->get() ;


        if(
            ($this->search != '')
            || ($this->query_year != '')
            || ($this->query_duration != '')
            || ($this->query_geoArea != '')
        ) {
            $this->track_nav_mode = "search" ;
        } else {
            $this->track_nav_mode = "tracks" ;
        }

        $this->track_nav_data = [] ;
        
        //set navagation mode to search
        //$this->track_nav_mode = "search" ;
        foreach ( $trans_tracks as $track) {
            $this->tracks[] = AudioItem::find($track->audio_item) ;

            $this->track_nav_data[] = $track->audio_item ;
        }

    }

    public function updated($name, $value) 
    {
        $this->playSearch() ;
    }

    public function mount()
    {
        $this->loadSelectOtpions();
        $this->playSearch() ;

    }
    public function render()
    {
        return view('livewire.tracks.search');
    }
}
