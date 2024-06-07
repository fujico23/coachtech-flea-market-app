<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment' => 'required|string|min:1|max:1000',
        ];
    }
    public function messages()
    {
        return [
            'comment.required' => '未入力です',
            'comment.string' => '文字列型で入力してください',
            'comment.max' => 'コメントが長すぎます',
            'comment.min' => 'コメントが短すぎます',
        ];
    }
}
