<?php

namespace App\Livewire\Admin\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

class UserEdit extends Component
{
    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.user.user-edit');
    }
}
