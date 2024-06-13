<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductRepository extends Repository
{
    private static $path = '/product';

    public static function model()
    {
        return Product::class;
    }

    public static function storeByRequest(ProductRequest $request)
    {
        $thumbnail = null;
        if ($request->hasFile('image')) {
            $thumbnail = MediaRepository::storeByRequest(
                $request->image,
                self::$path,
                'Image',
            );
        }
        $product_list = null;
        $qty_list = null;
        $price_list = null;

        if ($request->type == 'Combo') {
            $product_list = json_encode($request->product_id);
            $qty_list = json_encode($request->qty);
            $price_list = json_encode($request->netUnitCost);
        }

        return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()->id,
            'type' => $request->type,
            'name' => $request->name,
            'code' => $request->code,
            'barcode_symbology' => $request->barcode_symbology,
            'thumbnail_id' => $thumbnail->id,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'price' => $request->price,
            'qty' => 0,
            'alert_quantity' => $request->alert_quantity,
            'is_featured' => $request->featured,
            'product_details' => $request->product_details,
            'purchase_unit_id' => $request->purchase_unit_id,
            'sale_unit_id' => $request->sale_unit_id,
            'cost' => $request->cost,
            'is_promotion_price' => $request->promotion,
            'promotion_price' => $request->promotion_price,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->last_date,
            'tax_id' => $request->tax_id,
            'tax_method' => $request->tax_method,
            'product_list' => $product_list,
            'qty_list' => $qty_list,
            'price_list' => $price_list,
            'is_batch' => $request->is_batch,
            'is_variant' => $request->is_variant,
        ]);
    }

    public static function updateByRequest(ProductRequest $request, Product $product)
    {
        $thumbnail = null;
        if ($request->hasFile('image')) {
            $thumbnail = MediaRepository::updateByRequest(
                $request->image,
                self::$path,
                'Image',
                $product->thumbnail
            );
        }

        $product_list = null;
        $qty_list = null;
        $price_list = null;

        if ($request->type == 'Combo') {
            $product_list = json_encode($request->product_id);
            $qty_list = json_encode($request->qty);
            $price_list = json_encode($request->netUnitCost);
        }

        return self::update($product, [
            'type' => $request->type,
            'name' => $request->name,
            'code' => $request->code,
            'barcode_symbology' => $request->barcode_symbology,
            'thumbnail_id' => $thumbnail ? $thumbnail->id : $product->thumbnail_id,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'price' => $request->price,
            'qty' => $product->qty ?? 0,
            'alert_quantity' => $request->alert_quantity,
            'is_featured' => $request->featured,
            'product_details' => $request->product_details,
            'purchase_unit_id' => $request->purchase_unit_id,
            'sale_unit_id' => $request->sale_unit_id,
            'cost' => $request->cost,
            'is_promotion_price' => $request->promotion,
            'promotion_price' => $request->promotion_price,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->last_date,
            'tax_id' => $request->tax_id,
            'tax_method' => $request->tax_method,
            'product_list' => $product_list,
            'qty_list' => $qty_list,
            'price_list' => $price_list,
            'is_batch' => $request->is_batch,
            'is_variant' => $request->is_variant,
        ]);
    }

    public static function search($search, $categoryId = null, $brandId = null)
    {
        $products = self::query()
            ->where('shop_id', self::mainShop()->id)
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->when($brandId, function ($query) use ($brandId) {
                $query->where('brand_id', $brandId);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'Like', "%{$search}%")
                    ->orWhere('code', 'Like', "%{$search}%");
            });

        return $products;
    }
    public static function updateQty($qty, $productId): Product
    {
        $product = self::find($productId);
        $totalQty =  $product->qty + $qty;
        $product->update([
            'qty' => $totalQty
        ]);
        return $product;
    }
}
