<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|string',
            'postal_code' => 'required|string|digits:7',
            'address' => 'required|string',
            //'icon_image' => 'file|mimes:jpg,jpeg,svg,JPG,JPEG,SVG|max:5000',
            'icon_image' => 'file|max:5000',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '文字列型で入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.string' => '数値を入力してください',
            'postal_code.digits' => '郵便番号は数字7桁で入力してください',
            'address.required' => '住所を入力してください',
            'address.string' => '文字列型で入力してください',
            'icon_image.mimes' => 'jpg,jpeg,svg形式を選択してください',
            'icon_image.max' => '画像のサイズは4MB以下でなければなりません。'
        ];
    }
}
