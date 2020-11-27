<?php

namespace ATOZ\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrepaidsPostFormRequest extends FormRequest
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
            'mobile_number' => 'required|numeric|digits_between:7,12|prefix',
            'value' => 'required|numeric|in:10000,50000,100000',
            'order_no' => 'unique'
        ];
    }

    public function messages()
    {
        return[
            'mobile_number.prefix' => 'Mobile Number must start with 081',
            'mobile_number.digits_between' => 'Mobile Number digits must between 7 and 12',
            'value.in' => 'Available values are only 10000, 50000, and 100000'
        ];
    }
}
