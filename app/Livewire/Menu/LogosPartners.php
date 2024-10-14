<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class LogosPartners extends Component
{
    public $logoPartner = "logoPartner";

    public function render()
    {
        return view('livewire.menu.logos-partners');
    }
}
