<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class SideMenu extends Component
{
    public $menuItem = 'menuItem';

    public function render()
    {
        return view('livewire.menu.side-menu');
    }
}
