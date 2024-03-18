<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{

    public $widget;

    #[Layout('layouts.admin-livewire')]
    public function render()
    {

        $users = User::count();

        // dd($users);

        $this->widget = [
            'users' => $users,
            //...
        ];

        return view('livewire.admin.home');
    }
}
