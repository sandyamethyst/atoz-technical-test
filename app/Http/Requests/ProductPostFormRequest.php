<?php

namespace ATOZ\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPostFormRequest extends FormRequest
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
            'product_name' => 'required|string|min:10|max:150',
            'shipping_address' => 'required|string|min:10|max:150',
            'price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return[
            'product_name.min' => 'Product name requires 10 to 150 characters',
            'product_name.max' => 'Product name requires 10 to 150 characters',
            'shipping_address.min' => 'Shipping address requires 10 to 150 characters',
            'shipping_address.max' => 'Shipping address requires 10 to 150 characters',
            'price.numeric' => 'Price must be numerical only'
        ];
    }
}
