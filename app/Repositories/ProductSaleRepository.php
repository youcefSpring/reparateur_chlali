<?php

namespace App\Repositories;

use App\Http\Requests\SaleRequest;
use App\Models\ProductSale;

class ProductSaleRepository extends Repository
{
    public static function model()
    {
        return ProductSale::class;
    }

    public static function getMonthlyTotalProductSales($shopID)
    {
        $SaleIds = SaleRepository::query()->where('shop_id', $shopID)->whereMonth('created_at', date('m'))->pluck('id')->toArray();

        return self::query()->whereIn('sale_id', $SaleIds)->whereMonth('created_at', date('m'))->get();
    }

    public static function storeByRequest(SaleRequest $request, $sale)
    {
        $products = ProductRepository::query()->whereIn('id', $request->product_ids)->get();
        foreach ($products as $key => $product) {
            $productTax = 0;
             $price = isset($request->price[$key]) ? $request->price[$key] : $product->price;

            if ($product->tax) {
                $productTax = $price * $product->tax->rate / 100;
            }

            self::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'net_unit_price' => $price,
                'qty' => $request->qty[$key],
                'discount' => 0,
                'tax_rate' => $product->tax?->rate,
                'tax' => $productTax,
                'total' => ($price + $productTax) * $request->qty[$key],
            ]);
        }

        return $sale;
    }
}
