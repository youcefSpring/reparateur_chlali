<?php

namespace App\Repositories;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyRepository extends Repository
{
    public static function model()
    {
        return Currency::class;
    }

    public static function storeByRequest(CurrencyRequest $request)
    {
        return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::mainShop()?->id,
            'name' => $request->name,
            'symbol' => $request->symbol,
            'code' => $request->code
        ]);
    }

    public static function updateByRequest(CurrencyRequest $request, Currency $currency)
    {
        $update = self::update($currency, [
            'name' => $request->name,
            'symbol' => $request->symbol,
            'code' => $request->code
        ]);

        return $update;
    }
}
