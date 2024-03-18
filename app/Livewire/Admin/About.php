<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class About extends Component
{

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.about');
    }
}
