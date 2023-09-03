<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'brand_id' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'subsubcategory_id' => 'required',
            'product_name' => 'required',
            'product_qty' => 'required',
            'product_tags' => 'required',
            'product_color' => 'required',
            'selling_price' => 'required|numeric',
            'discount_price'=>'nullable|numeric|lt:selling_price',
            'product_thambnail'=>'required|image',
             'multi_img.*'=>'required|image',
            'specifications' => 'required',
            'long_descp' => 'required',
            'product_code' => ['required', Rule::unique(table:'products')],


        ];
    }

    public function messages(): array
{
    return [
       ' brand_id.required' => 'Please Select Relevent Product Brands',
        'category_id.required' => 'Please Select Relevent Product categories',
        'subcategory_id.required' => 'Please Select Relevent Product Sub categories',
        'subsubcategory_id.required' => 'Please Select Relevent Product Sub Sub categories',
       
    ];
}

}
