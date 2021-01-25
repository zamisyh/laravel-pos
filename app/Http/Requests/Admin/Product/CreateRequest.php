<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'string|max:10|unique:products',
            'name' => 'required|string|min:2',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required|min:10|nullable',
            'image' => 'required|file|image|mimes:jpeg,jpg,png',
            'category' => 'required|exists:categories,id'
        ];
    }
}
