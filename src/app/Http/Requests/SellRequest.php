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
            'child_category_id' => 'required_with:category_id',
            'grandchild_category_id' => 'required_with:child_category_id',
            'condition_id' => 'required',
            'image_url' => 'required',
            'image_url.*' => 'required|image|max:5000',
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
            'child_category_id.required_with' => '子カテゴリーを入力してください',
            'grandchild_category_id.required_with' => '孫カテゴリーを入力してください',
            'condition_id.required' => '商品の状態を入力してください',
            'image_url.required' => '画像をアップロードしてください',
            'image_url.*.required' => '画像をアップロードしてください',
            'image_url.*.file' => 'アップロードされたファイルは画像でなければなりません。',
            'image_url.*.mimes' => 'jpg,jpeg,svg形式を選択してください',
            'image_url.*.max' => '画像のサイズは5MB以下でなければなりません。'
        ];
    }
}
