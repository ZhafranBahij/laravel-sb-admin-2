<?php

namespace App\Livewire\Admin\Role;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RoleIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updated($search)
    {
        $this->resetPage();
    }

    public function flash_message()
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
    }

    public function delete($id){
        Role::find($id)->delete();

        session(['success' => 'Data successfully deleted.']);

        return $this->redirect('/role', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $this->flash_message();

        $roles = Role::query()
        ->whereAny([
            'name',
        ], 'LIKE', '%'.$this->search.'%')
        ->with(['permissions'])
        ->paginate(10);

        return view('livewire.admin.role.role-index', ['roles' => $roles]);
    }
}
