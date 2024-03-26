<?php

namespace App\Livewire\Cms;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProfileEdit extends Component
{

    #[Validate]
    public $user, $name, $last_name, $email;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $this->name = $this->user->name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
        ];
    }

    public function save()
    {

        $this->validate();
        $user = User::find(auth()->user()->id);
        $user->update(
            $this->except(['user'])
        );

        session()->flash('success', 'Data successfully updated.');

        $user->save();
        return $this->redirect(route('profile.edit'), true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.cms.profile-edit');
    }
}
