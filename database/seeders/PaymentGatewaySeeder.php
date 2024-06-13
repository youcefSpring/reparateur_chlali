<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $credentials = [
            [
                'name' => 'Stripe',
                'value' => json_encode([
                    'public_key' => null,
                    'secret_key' => null
                ]),
                'status' => 'Active',
            ]
        ];
        foreach ($credentials as $credential) {
            PaymentGateway::create([
                'name' => $credential['name'],
                'value' => $credential['value'],
                'status' => $credential['status'],
            ]);
        }
    }
}
