<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'brand_id' => 'required',
            'price' => 'required|integer',
            'description' => 'max:1000',
            'color_id' => 'required',
            'category_id' => 'required',
            'condition_id' => 'required',
            'image_url.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.string' => '文字列型で入力してください',
            'name.max' => '商品名が長すぎます',
            'brand_id.required' => 'ブランドを入力してください',
            'price.required' => '金額を入力してください',
            'price.integer' => '数値を入力してください',
            'description.max' => '商品の説明は1,000文字以内で入力してください',
            'color_id.required' => 'カラーを入力してください',
            'category_id.required' => 'カテゴリーを入力してください',
            'condition_id.required' => '商品の状態を入力してください',
            'image_url.*.required' => '画像をアップロードしてください',
            'image_url.*.image' => 'アップロードされたファイルは画像でなければなりません。',
            'image_url.*.mimes' => '画像形式はjpeg, png, jpg, gif, svgのいずれかでなければなりません。',
            'image_url.*.max' => '画像のサイズは2MB以下でなければなりません。'
        ];
    }
}
