<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ['date', 'account_id', 'category_id', 'member_id', 'amount', 'description', 'updated_by'];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeIncome(Builder $query): Builder
    {
        return $query->whereRelation('category', 'type', 'income');
    }

    public function scopeExpense(Builder $query): Builder
    {
        return $query->whereRelation('category', 'type', 'expense');
    }
}
