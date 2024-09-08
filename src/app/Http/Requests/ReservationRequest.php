<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shop_id' => 'required|exists:shops,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1|max:4',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を入力してください。',
            'reservation_time.required' => '予約時間を入力してください。',
            'number_of_people.required' => '人数を入力してください。',
        ];
    }
}
