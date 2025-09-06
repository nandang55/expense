<?php

namespace App\Livewire\Widgets;

use App\Models\Category;
use App\Models\Transaction;
use Livewire\Component;

class CategoryTotalWidget extends Component
{
    public $categoryId = '';
    public $category = null;
    public $total_income = 0;
    public $total_expense = 0;
    public $total_transactions = 0;
    public $show_widget = false;

    protected $listeners = ['categoryChanged' => 'updateCategory'];

    public function mount($categoryId = null)
    {
        $this->categoryId = $categoryId;
        $this->loadCategoryData();
    }

    public function updateCategory($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->loadCategoryData();
    }

    public function updatedCategoryId()
    {
        $this->loadCategoryData();
    }

    private function loadCategoryData()
    {
        if (empty($this->categoryId)) {
            $this->show_widget = false;
            return;
        }

        $this->category = Category::find($this->categoryId);
        
        if (!$this->category) {
            $this->show_widget = false;
            return;
        }

        // Get transactions for this category
        $transactions = Transaction::where('category_id', $this->categoryId)->get();
        
        $this->total_transactions = $transactions->count();
        
        if ($this->category->type === 'income') {
            $this->total_income = $transactions->sum('amount');
            $this->total_expense = 0;
        } else {
            $this->total_income = 0;
            $this->total_expense = $transactions->sum('amount');
        }

        $this->show_widget = true;
    }

    public function render()
    {
        return view('livewire.widgets.category-total-widget');
    }
}