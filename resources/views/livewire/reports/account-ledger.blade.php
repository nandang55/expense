<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-4">
        <x-layouts.breadcrumb heading="Account Ledger" sub-heading="View account transaction history"/>

        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.print()">
                <i class="fa fa-print me-1"></i>
                Print
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card card-body shadow-sm mb-4">
        <h5 class="card-title">Filter Options</h5>
        <form wire:submit.prevent="$refresh">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="selected_account_id" class="form-label">Select Account <span class="text-danger">*</span></label>
                    <select class="form-control select2" wire:model="selected_account_id" id="selected_account_id">
                        <option value="">Choose Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" class="form-control" wire:model="date_from" id="date_from">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" class="form-control" wire:model="date_to" id="date_to">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="per_page" class="form-label">Per Page</label>
                    <select class="form-control" wire:model="per_page" id="per_page">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search me-1"></i>
                        Generate Report
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="resetFilters">
                        <i class="fa fa-refresh me-1"></i>
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if($selected_account_id && $account)
        <!-- Account Summary -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <h6 class="card-title text-primary">Account</h6>
                        <h4 class="text-primary">{{ $account->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h6 class="card-title text-info">Opening Balance</h6>
                        <h4 class="text-info">{{ number_format($opening_balance, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h6 class="card-title text-success">Closing Balance</h6>
                        <h4 class="text-success">{{ number_format($closing_balance, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="card card-body shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Member</th>
                            <th class="text-end">Debit</th>
                            <th class="text-end">Credit</th>
                            <th class="text-end">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $running_balance = $opening_balance;
                        @endphp
                        
                        @forelse($transactions as $transaction)
                            @php
                                $is_income = $transaction->category->type === 'income';
                                $running_balance += $transaction->amount;
                            @endphp
                            <tr>
                                <td>{{ $transaction->date->format('d-m-Y') }}</td>
                                <td>{{ $transaction->description ?: '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $is_income ? 'success' : 'danger' }}">
                                        {{ $transaction->category->name }}
                                    </span>
                                </td>
                                <td>
                                    @if($transaction->member)
                                        <span class="badge bg-info">{{ $transaction->member->name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($is_income)
                                        <span class="text-success">{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if(!$is_income)
                                        <span class="text-danger">{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <strong>{{ number_format($running_balance, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">No transactions found for the selected period</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $transactions->links() }}
        </div>
    @else
        <!-- No Account Selected -->
        <div class="card card-body shadow-sm text-center">
            <div class="py-5">
                <i class="fa fa-chart-line fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Select an Account to View Ledger</h5>
                <p class="text-muted">Choose an account from the filter above to generate the account ledger report.</p>
            </div>
        </div>
    @endif
</div>

@push('js')
<script>
$(document).ready(function() {
    // Initialize Select2 for account
    $('.select2').select2({
        theme: "bootstrap-5",
        placeholder: "Choose Account"
    });

    $('.select2').change(function (){
        Livewire.first().selected_account_id = $(this).val()
    })
})

// Re-initialize Select2 after Livewire updates
document.addEventListener('livewire:updated', function () {
    $('.select2').select2({
        theme: "bootstrap-5",
        placeholder: "Choose Account"
    });

    $('.select2').change(function (){
        Livewire.first().selected_account_id = $(this).val()
    })
});
</script>
@endpush