<?php

namespace App\Livewire\Admin\Role;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{

    public $permissions;
    public $permissions_in_rule = [];

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

        $role = Role::create(
            $this->only('name')
        );

        $role->syncPermissions($this->permissions_in_rule);

        session()->flash('success', 'Data successfully created.');

        return $this->redirect('/role', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $this->permissions = Permission::all()->pluck('name');
        return view('livewire.admin.role.role-create');
    }
}
