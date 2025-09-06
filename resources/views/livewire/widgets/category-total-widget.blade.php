<div>
    @if($show_widget && $category)
    <div class="card border-0 shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex align-items-center">
                <i class="{{ $category->icon }} me-2"></i>
                <h6 class="mb-0">{{ $category->name }} Total</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                @if($category->type === 'income')
                    <h4 class="text-success mb-1">{{ number_format($total_income, 0, ',', '.') }}</h4>
                    <small class="text-muted">Total Income</small>
                @else
                    <h4 class="text-danger mb-1">{{ number_format($total_expense, 0, ',', '.') }}</h4>
                    <small class="text-muted">Total Expense</small>
                @endif
            </div>
            <hr class="my-3">
            <div class="text-center">
                <h5 class="text-primary mb-1">{{ $total_transactions }}</h5>
                <small class="text-muted">Total Transactions</small>
            </div>
            <div class="mt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Category Type:</small>
                    <span class="badge bg-{{ $category->type === 'income' ? 'success' : 'danger' }}">
                        {{ ucfirst($category->type) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>