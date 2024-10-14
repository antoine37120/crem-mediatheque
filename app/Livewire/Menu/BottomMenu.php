<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class BottomMenu extends Component
{
    public $menuItem = "menuItem";

    public function render()
    {
        return view('livewire.menu.bottom-menu');
    }
}
