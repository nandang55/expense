<?php

namespace App\Livewire\Reports;

use App\Models\Transaction;
use Livewire\Component;

class Calendar extends Component
{
    public function render()
    {
        $transactions = Transaction::with(['category', 'account', 'member'])
            ->whereMonth('date', date('m'))
            ->get();
        $transactions_data = [];
        foreach ($transactions as $transaction) {
            $transactions_data[] = [
                'title' => $transaction->category->name,
                'start' => $transaction->date->format('Y-m-d'),
                'className' => $transaction->category->type == 'expense' ? 'badge border-0 bg-danger' : 'badge border-0 bg-success',
                'extendedProps' => [
                    'date' => $transaction->date->format('d-m-Y'),
                    'account' => $transaction->account->name,
                    'category' => $transaction->category->name,
                    'amount' => number_format($transaction->amount),
                    'description' => $transaction->description,
                    'member' => $transaction->member ? $transaction->member->name : '-',
                    'member_nik' => $transaction->member ? $transaction->member->nik : '-',
                ]
            ];
        }

        return view('livewire.reports.calendar', [
            'transactions_data' => json_encode($transactions_data)
        ]);
    }
}
