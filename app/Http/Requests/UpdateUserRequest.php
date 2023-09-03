<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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

           
            'specifications' => 'required',
            'long_descp' => 'required',
            'product_code' => ['required', Rule::unique(table:'products')->ignore($this->product)],

        ];
        
        
        
       return rules;



    }

}
