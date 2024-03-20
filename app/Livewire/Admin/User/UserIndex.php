<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search;

    public function updated($search)
    {
        $this->resetPage();
    }

    public function delete($id){
        User::find($id)->delete();

        session()->flash('success', 'Data successfully deleted.');

        return $this->redirect('/user', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $users = User::query()
                    ->whereAny([
                        'name',
                        'last_name',
                        'email',
                    ], 'LIKE', '%'.$this->search.'%')
                    ->with(['roles'])
                    ->simplePaginate(10);

        return view('livewire.admin.user.user-index', ['users' => $users]);
    }
}
