<?php

namespace App\Repositories;

use App\Http\Requests\SaleReturnRequest;
use App\Models\Sale;
use App\Models\SaleReturn;

class SaleReturnRepository extends Repository
{
    public static function model()
    {
        return SaleReturn::class;
    }
    public static function storeByRequest(SaleReturnRequest $request, Sale $sale)
    {
        $referenceNo = 'rrp-' . date("Ymd") . '-' . date("his");
        return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()->id,
            'reference_no' => $referenceNo,
            'total_discount' => $sale->total_discount - $request->total_discount,
            'total_tax' => $sale->total_tax - $request->total_tax,
            'total_qty' => $sale->total_qty - $request->total_qty,
            'item' => $sale->item - $request->item,
            'total_price' => $sale->total_price - $request->total_price,
            'order_tax' => $sale->order_tax - $request->order_tax,
            'grand_total' => $sale->grand_total - $request->grand_total,
            'sale_note' => $request->note,
        ]);
    }
}
