<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'product_qty' => 'required',
            'product_tags' => 'required',
            'product_color' => 'required',
            'selling_price' => 'required|numeric',
            'discount_price'=>'numeric|lt:selling_price|nullable',
            'product_thambnail' => 'required|image',
            'multi_img[]' => 'required|image',
            'specifications' => 'required',
            'long_descp' => 'required',
        ];
    }

    public function messages(): array
{
    return [
        'product_code.required' => 'A unique Product code is required',
       
    ];
}

    
       
}
