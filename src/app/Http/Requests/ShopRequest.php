<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'location' => 'required|string|max:20',
            'category' => 'required|string|max:191',
            'genre' => 'required|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください。',
            'name.max' => '店舗名は191文字以内で入力してください。',
            'location.required' => '場所を入力してください。',
            'location.max' => '場所は20文字以内で入力してください。',
            'category.required' => 'カテゴリーを入力してください。',
            'category.max' => 'カテゴリーは191文字以内で入力してください。',
            'genre.required' => 'ジャンルを入力してください。',
            'genre.max' => 'ジャンルは20文字以内で入力してください。',
        ];
    }
}
