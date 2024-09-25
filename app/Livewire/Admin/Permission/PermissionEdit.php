<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends Component
{
    public $id;

    #[Validate]
    public $name;

    public function mount(Permission $permission)
    {
        $this->id = $permission->id;
        $this->name = $permission->name;
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

        Permission::find($this->id)->update(
            $this->all()
        );

        session(['success' => 'Data successfully updated.']);

        return $this->redirect('/permission', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.permission.permission-edit');
    }
}
