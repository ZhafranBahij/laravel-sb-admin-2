<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionCreate extends Component
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

        Permission::create(
            $this->all()
        );

        session()->flash('success', 'Data successfully created.');

        return $this->redirect('/permission', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        return view('livewire.admin.permission.permission-create');
    }
}
