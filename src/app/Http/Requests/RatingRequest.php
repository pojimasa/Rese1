<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を選択してください。',
            'comment.required' => 'コメントを入力してください。',
            'comment.max' => 'コメントは500文字以内で入力してください。',
        ];
    }
}
