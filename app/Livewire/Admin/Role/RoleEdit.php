<?php

namespace App\Livewire\Admin\Role;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{

    public $id, $permissions_in_rule = [], $permissions;

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

        $role = Role::find($this->id);
        $role->update(
            $this->only('name')
        );
        $role->syncPermissions($this->permissions_in_rule);

        session(['success' => 'Data successfully updated.']);

        return $this->redirect('/role', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $this->permissions = Permission::all()->pluck('name');
        $role = Role::find($this->id);
        $this->permissions_in_rule = $role->permissions->pluck('name');
        return view('livewire.admin.role.role-edit');
    }
}
