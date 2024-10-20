<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Livewire\Attributes\Url;

class SideMenu extends Component
{
    public $menuItem = 'menuItem';
    
    #[Url(as: 'q')]
    public $search ;

    public function searchLauch() {

        return $this->redirect(route('search').'?q='.$this->search, navigate: true);
    }

    public function render()
    {
        return view('livewire.menu.side-menu');
    }
}
