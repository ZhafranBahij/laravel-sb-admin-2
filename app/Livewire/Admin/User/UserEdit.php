<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserEdit extends Component
{

    public $id;
    #[Validate]
    public $name, $last_name, $email, $password;

    public function mount(User $user){
        $this->id = $user->id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
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

        User::find($this->id)->update(
            $this->all()
        );

        session()->flash('success', 'Data successfully updated.');

        return $this->redirect('/user', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.user.user-edit');
    }
}
