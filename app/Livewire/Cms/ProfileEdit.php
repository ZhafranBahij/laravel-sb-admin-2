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
        $this->name = auth()->user()->name;
        $this->last_name = auth()->user()->last_name;
        $this->email = auth()->user()->email;
    }

    public function rules()
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.last_name' => 'nullable|string|max:255',
            'user.email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            // 'current_password' => 'nullable|required_with:new_password',
            // 'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            // 'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ];
    }

    public function save()
    {

        $this->validate();

        dd($this->user->all());

        $user = User::findOrFail(auth()->user()->id);
        $user->update(
            $this->user
        );
        // $user->name = $this->user->name;
        // $user->last_name = $this->user->last_name;
        // $user->email = $this->user->email;

        // dd($user);
        // if (!is_null($request->input('current_password'))) {
        //     if (Hash::check($request->input('current_password'), $user->password)) {
        //         $user->password = $request->input('new_password');
        //     } else {
        //         return redirect()->back()->withInput();
        //     }
        // }

        $user->save();
        return $this->redirect(route('profile.edit'), true);
        // return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.cms.profile-edit');
    }
}
