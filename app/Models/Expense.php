<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = ['id'];

    public function warehouse()
    {
    	return $this->belongsTo(Warehouse::class)->withTrashed();
    }

    public function expenseCategory() {
    	return $this->belongsTo(ExpenseCategory::class,'expense_category_id');
    }
}
