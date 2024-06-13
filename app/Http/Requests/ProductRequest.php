<?php

namespace App\Http\Requests;

use App\Repositories\GeneralSettingRepository;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $image = 'required|mimes:png,jpg,jpeg';

        if (request()->isMethod('put')) {
            $image = 'nullable|mimes:png,jpg,jpeg';
        } elseif ($this->type == 'combo') {
            $image = 'nullable|mimes:png,jpg,jpeg';
        }

        $unit_id = 'required|integer';
        $sale_unit_id = 'required|integer';
        $purchase_unit_id = 'required|integer';
        $price = 'required|numeric|max:9999999';
        $cost = 'required|numeric|max:9999999';

        if ($this->type == 'combo') {
            $unit_id = 'nullable|integer';
            $sale_unit_id = 'nullable|integer';
            $purchase_unit_id = 'nullable|integer';
            $price = 'nullable|numeric|max:9999999';
            $cost = 'nullable|numeric|max:9999999';
            $image = 'required|mimes:png,jpg,jpeg';
        }
        $mainShop = mainShop();
        if ($mainShop) {
            $generalSettings = GeneralSettingRepository::query()->where('shop_id', $mainShop->id)->first();
        }
        $digits = $generalSettings->barcode_digits ?? 8;
        return [
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image' => $image,
            'code' => 'required|numeric|digits_between:' . $digits . ',' . $digits . '|unique:products,code,' . $this->product?->id,
            'price' => $price,
            'cost' => $cost,
            'barcode_symbology' => 'required|string|max:255',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'unit_id' => $unit_id,
            'sale_unit_id' => $sale_unit_id,
            'purchase_unit_id' => $purchase_unit_id,
            'alert_quantity' => 'nullable|integer',
            'is_featured' => 'nullable',
            'product_details' => 'nullable|string',
            'variant_name' => 'nullable|array',
            'item_code' => 'nullable|array',
            'additional_price' => 'nullable|array',
        ];
    }
}
