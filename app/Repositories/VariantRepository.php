<?php

namespace App\Repositories;

use App\Models\Variant;

class VariantRepository extends Repository
{
    public static function model()
    {
        return Variant::class;
    }
    public static function storyByRequest($variantName)
    {
        return self::create([
            'name' => $variantName,
        ]);
    }
}
