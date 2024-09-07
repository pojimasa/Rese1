<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'message' => 'required|string|max:500',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'お知らせ内容を入力してください。',
            'message.max' => 'お知らせ内容は500文字以内で入力してください。',
            'user_ids.array' => 'ユーザー選択に誤りがあります。',
            'user_ids.*.exists' => '選択されたユーザーが存在しません。',
        ];
    }
}

