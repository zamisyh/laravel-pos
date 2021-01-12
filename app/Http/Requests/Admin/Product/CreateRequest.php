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
            'name' => 'required|min:2',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required|min:10',
            'image' => 'required|file|image|mimes:jpeg,jpg,png',
            'category' => 'required'
        ];
    }
}
