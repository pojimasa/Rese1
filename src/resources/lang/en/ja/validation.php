<?php

return [
    'required' => ':attribute は必須です。',
    'string' => ':attribute は文字列でなければなりません。',
    'max' => [
        'string' => ':attribute は:max 文字以内でなければなりません。',
    ],
    'min' => [
        'string' => ':attribute は :min 文字以上でなければなりません。',
    ],
    'integer' => ':attribute は整数でなければなりません。',
    'between' => [
        'numeric' => ':attribute は :min から :max までの値でなければなりません。',
        'file' => ':attribute は :min キロバイトから :max キロバイトの間でなければなりません。',
        'string' => ':attribute は :min 文字から :max 文字の間でなければなりません。',
        'array' => ':attribute は :min 個から :max 個のアイテムでなければなりません。',
    ],
    'exists' => '選択した :attribute は無効です。',
    'unique' => ':attribute はすでに使用されています。',
    'confirmed' => ':attribute の確認が一致しません。',
    'after' => ':attribute には :date 以降の日付を指定してください。',
    'before' => ':attribute には :date 以前の日付を指定してください。',
    'date' => ':attribute は有効な日付でなければなりません。',
    'url' => ':attribute は有効なURLでなければなりません。',
    'file' => ':attribute はファイルでなければなりません。',
    'mimes' => ':attribute は以下のタイプのファイルでなければなりません: :values。',
    'image' => ':attribute は画像でなければなりません。',
    'boolean' => ':attribute は真偽値でなければなりません。',
    // さらに必要なエラーメッセージを追加
    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => '確認用パスワード',
        'shop_id' => '店舗',
        'rating' => '評価',
        'comment' => 'コメント',
        // 追加の属性
        'message' => 'お知らせ内容',
    ],
];
