<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{

    public $roles, $user_has_roles = [];

    #[Validate]
    public $name, $last_name, $email, $password;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users.email,' . auth()->user()->id,
            'password' => 'required',
        ];
    }

    public function save()
    {

        $this->validate();

        $user = User::create(
            $this->except(['user_has_roles'])
        );

        $user->assignRole($this->user_has_roles);
        session(['success' => 'Data successfully created.']);

        return $this->redirect('/user', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {

        if (! Auth::user()->can('edit articles')) {
            return $this->redirect('/user', true);
        }

        $this->roles = Role::all()->pluck('name');

        return view('livewire.admin.user.user-create');
    }
}
