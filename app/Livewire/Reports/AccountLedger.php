<?php

namespace App\Livewire\Reports;

use App\Models\Account;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class AccountLedger extends Component
{
    use WithPagination;

    public $selected_account_id = '';
    public $date_from = '';
    public $date_to = '';
    public $per_page = 25;

    protected $queryString = [
        'selected_account_id' => ['except' => ''],
        'date_from' => ['except' => ''],
        'date_to' => ['except' => ''],
        'per_page' => ['except' => 25],
    ];

    public function mount()
    {
        // Set default date range to current month
        $this->date_from = now()->startOfMonth()->format('Y-m-d');
        $this->date_to = now()->endOfMonth()->format('Y-m-d');
    }

    public function resetFilters()
    {
        $this->selected_account_id = '';
        $this->date_from = now()->startOfMonth()->format('Y-m-d');
        $this->date_to = now()->endOfMonth()->format('Y-m-d');
        $this->per_page = 25;
    }

    public function render()
    {
        $accounts = Account::all();
        
        $transactions = collect();
        $account = null;
        $opening_balance = 0;
        $closing_balance = 0;

        if ($this->selected_account_id) {
            $account = Account::find($this->selected_account_id);
            
            if ($account) {
                // Get opening balance (sum of all transactions before date_from)
                $opening_balance = Transaction::where('account_id', $this->selected_account_id)
                    ->where('date', '<', $this->date_from)
                    ->sum('amount');

                // Get transactions in date range
                $transactions = Transaction::with(['category', 'member'])
                    ->where('account_id', $this->selected_account_id)
                    ->whereBetween('date', [$this->date_from, $this->date_to])
                    ->orderBy('date', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->paginate($this->per_page);

                // Calculate closing balance
                $closing_balance = $opening_balance + $transactions->sum('amount');
            }
        }

        return view('livewire.reports.account-ledger', [
            'accounts' => $accounts,
            'transactions' => $transactions,
            'account' => $account,
            'opening_balance' => $opening_balance,
            'closing_balance' => $closing_balance,
        ]);
    }
}