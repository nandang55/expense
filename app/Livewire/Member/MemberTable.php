<?php

namespace App\Livewire\Member;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class MemberTable extends Component
{
    use WithPagination;

    public $search = '';
    public $per_page = 10;
    public $delete_id = '';

    public function render()
    {
        $members = Member::search($this->search)
            ->latest()
            ->paginate($this->per_page);

        return view('livewire.member.member-table', [
            'members' => $members,
        ]);
    }

    public function setDeleteId($id)
    {
        $this->delete_id = $id;
    }

    public function delete()
    {
        $member = Member::find($this->delete_id);
        if ($member) {
            $member->delete();
            $this->reset('delete_id');
        }
    }

    public function updated($property)
    {
        if (in_array($property, ['search', 'per_page'])) {
            $this->resetPage();
        }
    }
}