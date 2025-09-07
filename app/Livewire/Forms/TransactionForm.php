<?php

namespace App\Livewire\Forms;

use App\Models\Transaction;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Form;

class TransactionForm extends Form
{
    public ?Transaction $transaction;

    #[Locked]
    public $id = '';

    #[Rule('required|date')]
    public $date = '';

    #[Rule('required|int')]
    public $account_id = '';

    #[Rule('required|int')]
    public $category_id = '';

    #[Rule('nullable|int')]
    public $member_id = '';

    #[Rule('required|numeric|min:0|max:9999999999999.99')]
    public $amount = '';

    #[Rule('nullable')]
    public $description = '';

    public $updated_by = '';

    public function store()
    {
        $this->validate();

        $data = $this->except('id');
        $data['member_id'] = $this->member_id ?: null;

        Transaction::create($data);
    }

    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        $this->id = $transaction->id;
        $this->date = $transaction->date->format('Y-m-d');
        $this->account_id = $transaction->account_id;
        $this->category_id = $transaction->category_id;
        $this->member_id = $transaction->member_id;
        $this->amount = $transaction->amount;
        $this->description = $transaction->description;
        $this->updated_by = $transaction->updated_by;
    }

    public function update()
    {
        $this->validate();

        $data = $this->all();
        $data['member_id'] = $this->member_id ?: null;

        $this->transaction->update($data);
    }
}
