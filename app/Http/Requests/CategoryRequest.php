<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $method = request()->isMethod('put');
        $isImageRequired = 'required';
        if ($method || $this->routeIs('categoryApi.update')) {
            $isImageRequired = 'nullable';
        }
        return [
            'name' => 'required|string|max:255',
            'image' => $isImageRequired . '|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
