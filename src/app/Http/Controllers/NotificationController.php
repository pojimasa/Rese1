<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Notifications\CustomNotification;
use App\Models\User;

class NotificationController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('notifications.create', compact('users'));
    }

    public function store(StoreNotificationRequest $request)
    {
        $message = $request->input('message');
        $userIds = $request->input('user_ids', []);

        if (empty($userIds)) {
            $users = User::all();
        } else {
            $users = User::whereIn('id', $userIds)->get();
        }

        foreach ($users as $user) {
            $user->notify(new CustomNotification($message));
        }

        return redirect()->route('notifications.create')->with('success', 'お知らせを送信しました。');
    }
}
