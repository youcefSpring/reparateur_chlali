<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tax = $this->tax->rate ?? 0;
        if ($tax > 0) {
            $tax = $this->price * $this->tax->rate / 100;
        }

        $discount = $this->discount ?? 0;

        if ($this->discount_type?->value == 'Percentage') {
            $discount = $this->price * $this->discount / 100;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'qty' => 0,
            'stock' => $this->qty,
            'thumbnail' => $this->thumbnail->file ?? asset('defualt/defualt.jpg'),
            'ending_date' => $this->ending_date ?? 'N/A',
            'price' => round($this->price, 2),
            'cost' => round($this->cost, 2),
            'discount' => round($discount, 2),
            'tax' => round($tax, 2),
            'subtotal' => round(($this->price - $discount) + $tax, 2),
            'batch' => $this->is_batch ? true : false,
            'tax_rate' => $this->tax->rate ?? 0,
        ];
    }
}
