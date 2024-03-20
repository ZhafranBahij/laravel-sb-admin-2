<?php

namespace App\Livewire\Admin\Role;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    #[Validate]
    public $name;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function save()
    {

        $this->validate();

        Role::create(
            $this->all()
        );

        session()->flash('success', 'Data successfully created.');

        return $this->redirect('/role', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.role.role-create');
    }
}
