<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseRequest extends FormRequest
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
            'pay_method' => ['required', Rule::in(['クレジットカード決済', 'コンビニ', '銀行振込'])],
            'shippingAddress.address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'pay_method.required' => '支払い方法を入力してください',
            'pay_method.in' => '有効な支払い方法を選択してください',
            'shippingAddress.address.required' => '配送先を選択してください',
        ];
    }
}
