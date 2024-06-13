<?php

namespace App\Repositories;

use App\Http\Requests\ShopCategoryRequest;
use App\Models\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoryRepository extends Repository
{

    public static function model()
    {
        return ShopCategory::class;
    }

    public static function storeByRequest(ShopCategoryRequest $request)
    {
        return self::create([
            'created_by' => auth()->id(),
            'name' => $request->name,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    }

    public static function updateByRequest(ShopCategoryRequest $request, ShopCategory $shopCategory)
    {
        return self::update($shopCategory, [
            'name' => $request->name,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    }
    
    public static function statusChanageByRequest(ShopCategory $shopCategory, $status)
    {
        return self::update($shopCategory, [
            'status' => $status,
        ]);
    }
}
