<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search;

    public function updated($search)
    {
        $this->resetPage();
    }

    public function delete($id){
        Permission::find($id)->delete();

        session()->flash('success', 'Data successfully deleted.');

        return $this->redirect('/permission', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $permissions = Permission::query()
        ->whereAny([
            'name',
        ], 'LIKE', '%'.$this->search.'%')
        ->simplePaginate(10);

        return view('livewire.admin.permission.permission-index', ['permissions' => $permissions]);
    }
}
