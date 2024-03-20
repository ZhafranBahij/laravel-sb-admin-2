<?php

namespace App\Livewire\Admin\Role;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{

    public $id;

    #[Validate]
    public $name;

    public function mount(Role $role)
    {
        $this->id = $role->id;
        $this->name = $role->name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function save()
    {

        $this->validate();

        Role::find($this->id)->update(
            $this->all()
        );

        session()->flash('success', 'Data successfully updated.');

        return $this->redirect('/role', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.role.role-edit');
    }
}
