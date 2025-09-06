<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Account;
use App\Models\Category;
use App\Models\Member;
use Livewire\Component;

class CreateTransaction extends Component
{
    public TransactionForm $form;

    public function render()
    {
        $this->form->date = date('Y-m-d');
        
        // Set default category to first available category
        if (empty($this->form->category_id)) {
            $firstCategory = Category::first();
            $this->form->category_id = $firstCategory ? $firstCategory->id : null;
        }
        
        // Set default account to first available account
        if (empty($this->form->account_id)) {
            $firstAccount = Account::first();
            $this->form->account_id = $firstAccount ? $firstAccount->id : null;
        }

        return view('livewire.transaction.create-transaction', [
            'categories' => Category::all(),
            'accounts' => Account::all(),
            'members' => Member::active()->get(),
        ]);
    }

    public function save()
    {
        $this->form->updated_by = auth()->user()->name;
        $this->form->store();

        return $this->redirect(TransactionTable::class, navigate: true);
    }
}
