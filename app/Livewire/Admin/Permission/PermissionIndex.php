<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PermissionIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updated($search)
    {
        $this->resetPage();
    }

    public function delete($id){

        Permission::find($id)->delete();

        session(['success' => 'Data successfully deleted.']);

        return $this->redirect('/permission', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {

        if (session('success') ?? null) {
            $this->alert(
                'success',
                session('success'),
                [
                    'toast' => false,
                    'position' => 'center',
                ],
            );
            session(['success' => null]);
        }

        $permissions = Permission::query()
        ->whereAny([
            'name',
        ], 'LIKE', '%'.$this->search.'%')
        ->paginate(10);

        return view('livewire.admin.permission.permission-index', ['permissions' => $permissions]);
    }
}
