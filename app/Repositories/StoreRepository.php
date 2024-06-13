<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreRepository extends Repository
{
    public static function model()
    {
        return Store::class;
    }

    public static function storeByRequest(Request $request, $shopManager)
    {
        return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()->id,
            'user_id' => $shopManager->id,
            'name' => $request->store_name,
            'description' => $request->description,
            'email' => $request->store_email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'status' => $request->status,
        ]);
    }

    public static function updateByRequest(Request $request, Store $store)
    {
        $update = self::update($store, [
            'name' => $request->store_name,
            'description' => $request->description,
            'email' => $request->store_email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return $update;
    }
}
