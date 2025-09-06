<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Account;
use App\Models\Category;
use App\Models\Member;
use App\Models\Transaction;
use Livewire\Component;

class EditTransaction extends Component
{
    public TransactionForm $form;

    public function mount(Transaction $transaction)
    {
        $this->form->setTransaction($transaction);
    }

    public function update()
    {
        $this->form->updated_by = auth()->user()->name;
        $this->form->update();

        return $this->redirect(TransactionTable::class, navigate: true);
    }

    public function render()
    {
        // Get all active members
        $members = Member::active()->get();
        
        // If there's a selected member, make sure it's included in the list
        if ($this->form->member_id) {
            $selectedMember = Member::find($this->form->member_id);
            if ($selectedMember && !$members->contains('id', $selectedMember->id)) {
                $members->push($selectedMember);
            }
        }

        // Get the selected member for display
        $selectedMember = null;
        if ($this->form->member_id) {
            $selectedMember = Member::find($this->form->member_id);
        }

        return view('livewire.transaction.edit-transaction', [
            'categories' => Category::all(),
            'accounts' => Account::all(),
            'members' => $members,
            'selectedMember' => $selectedMember,
            'form' => $this->form,
        ]);
    }
}
