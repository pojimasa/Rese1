<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable) {
            return (new MailMessage)
                ->subject('メール確認のお知らせ')
                ->line('以下のボタンをクリックしてメールアドレスを確認してください。')
                ->action('メールアドレス確認', url('email/verify/'.$notifiable->id.'/'.$notifiable->verification_token));
        });
    }
}

