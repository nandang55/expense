<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $search = '';
    public $per_page = 10;
    public $deleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'per_page' => ['except' => 10],
    ];

    public function setDeleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        if ($this->deleteId) {
            User::find($this->deleteId)->delete();
            session()->flash('message', 'User deleted successfully.');
            $this->deleteId = null;
        }
    }

    public function render()
    {
        $users = User::with('member')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhereHas('member', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('nik', 'like', '%' . $this->search . '%');
                      });
            })
            ->paginate($this->per_page);

        return view('livewire.user.user-table', [
            'users' => $users,
        ]);
    }
}