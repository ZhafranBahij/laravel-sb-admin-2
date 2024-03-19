<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserCreate extends Component
{
    #[Validate]
    public $name, $last_name, $email, $password;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            'password' => 'required',
        ];
    }

    public function save()
    {

        $this->validate();

        User::create(
            $this->all()
        );

        session()->flash('success', 'Data successfully created.');

        return $this->redirect('/user', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.user.user-create');
    }
}
