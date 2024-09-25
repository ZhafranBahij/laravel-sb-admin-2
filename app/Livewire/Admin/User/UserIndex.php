<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserIndex extends Component
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
        User::find($id)->delete();

        session(['success' => 'Data successfully deleted.']);

        return $this->redirect('/user', true);
    }

    #[Layout('layouts.admin-livewire')]
    public function render()
    {
        $this->flash_message();

        $users = User::query()
                    ->whereAny([
                        'name',
                        'last_name',
                        'email',
                    ], 'LIKE', '%'.$this->search.'%')
                    ->with(['roles'])
                    ->latest()
                    ->paginate(10);

        return view('livewire.admin.user.user-index', ['users' => $users]);
    }
}
