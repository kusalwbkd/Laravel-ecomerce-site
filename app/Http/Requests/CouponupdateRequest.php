<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponupdateRequest extends FormRequest
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
            'coupon_name' => 'required',
            'discount' => 'required|numeric',
            'validity' => 'required|date',
            

        ];
    }

    public function messages(): array
{
    return [
       ' coupon_name.required' => 'Please Select Relevent Coupon name',
        'discount.required' => 'Please Select Relevent Coupon discount',
        'discount.numeric' => 'Please Select a numeric value',
     
       
    ];
}
}
