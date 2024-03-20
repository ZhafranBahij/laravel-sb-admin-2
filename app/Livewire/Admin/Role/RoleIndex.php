<?php

namespace App\Livewire\Admin\Role;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search;

    public function updated($search)
    {
        $this->resetPage();
    }

    public function delete($id){
        Role::find($id)->delete();

        session()->flash('success', 'Data successfully deleted.');

        return $this->redirect('/role', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $roles = Role::query()
        ->whereAny([
            'name',
        ], 'LIKE', '%'.$this->search.'%')
        ->with(['permissions'])
        ->simplePaginate(10);

        return view('livewire.admin.role.role-index', ['roles' => $roles]);
    }
}
