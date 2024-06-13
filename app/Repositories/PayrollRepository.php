<?php

namespace App\Repositories;

use App\Http\Requests\PayrollRequest;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollRepository extends Repository
{
    public static function model()
    {
        return Payroll::class;
    }
    public static function storeByRequest(PayrollRequest $request)
    {
        $create = self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()->id,
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'account_id' => $request->account_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        return $create;
    }

    public static function updateByRequest(PayrollRequest $request, Payroll $payroll)
    {
        $update = self::update($payroll, [
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'account_id' => $request->account_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        return $update;
    }
}
