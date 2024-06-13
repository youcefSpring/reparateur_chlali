<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencys = [
            [
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$'
            ],
            [
                'name' => 'Euro',
                'code' => 'EURO',
                'symbol' => '€'
            ],
            [
                'name' => 'Taka',
                'code' => 'TAKA',
                'symbol' => '৳'
            ]
        ];
        foreach ($currencys as $currency) {
            CurrencyRepository::create($currency);
        }

        $shopCurrencys = [
            [
                'shop_id' => 1,
                'created_by' => 2,
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$'
            ],
            [
                'shop_id' => 1,
                'created_by' => 2,
                'name' => 'Euro',
                'code' => 'EURO',
                'symbol' => '€'
            ],
            [
                'shop_id' => 1,
                'created_by' => 2,
                'name' => 'Taka',
                'code' => 'TAKA',
                'symbol' => '৳'
            ]
        ];
        foreach ($shopCurrencys as $currency) {
            CurrencyRepository::create($currency);
        }
    }
}
