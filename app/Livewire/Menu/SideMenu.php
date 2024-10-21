<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Log;

class SideMenu extends Component
{
    public $menuItem = 'menuItem';
    
    #[Url(as: 'q')]
    public $search ;

    #[Url(as: 'year')]
    public $query_year = '';

    #[Url(as: 'geoArea')]
    public $query_geoArea = '';

    #[Url(as: 'duration')]
    public $query_duration = '';
    


    #[On('search-facets-change')] 
    public function updateQuerySerachParams($year, $geoArea, $duration)
    {
        $this->query_year = $year ;
        $this->query_geoArea = $geoArea ;
        $this->query_duration = $duration ; 
    }

    public function searchLauch() {

        $get_params = '&year='.$this->query_year.'&geoArea='.$this->query_geoArea.'&duration='.$this->query_duration;
        return $this->redirect(route('search').'?q='.$this->search.$get_params, navigate: true);
    }

    public function render()
    {
        return view('livewire.menu.side-menu');
    }
}
