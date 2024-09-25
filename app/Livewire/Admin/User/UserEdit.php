<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{

    public $id, $roles, $user_has_roles = [];
    #[Validate]
    public $name, $last_name, $email, $password;

    public function mount(User $user){
        $this->id = $user->id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->user_has_roles = $user->getRoleNames();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255' . auth()->user()->id,
        ];
    }

    public function save()
    {

        $this->validate();

        $user = User::find($this->id);

        $user->update(
            $this->except(['user_has_roles'])
        );

        $user->syncRoles($this->user_has_roles);

        session(['success' => 'Data successfully updated.']);

        return $this->redirect('/user', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $this->roles = Role::all()->pluck('name');

        return view('livewire.admin.user.user-edit');
    }
}
