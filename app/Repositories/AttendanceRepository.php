<?php

namespace App\Repositories;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceRepository extends Repository
{
    public static function model()
    {
        return Attendance::class;
    }
    public static function storeByRequest(AttendanceRequest $request)
    {
         return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()->id,
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
        ]);
    }
}
