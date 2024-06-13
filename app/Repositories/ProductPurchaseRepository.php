<?php
namespace App\Repositories;
use App\Models\ProductPurchase;

class ProductPurchaseRepository extends Repository
{
    public static function model()
    {
        return ProductPurchase::class;
    }

    public static function storeByRequet(array $product, $purchase)
    {
            return self::create([
                'product_id' => $product['id'],
                'purchase_id' => $purchase->id,
                'qty' => $product['qty'],
                'purchase_unit_id' => 1,
                'net_unit_cost' => $product['netUnitCost'],
                'discount' => $product['discount'] ?? 0,
                'tax_rate' => $product['textRate'],
                'tax' => $product['tax'],
                'total' => $product['subTotal'],
            ]);
    }
}
