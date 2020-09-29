<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class Aakash
{
    const url="https://aakashsms.com/admin/public/sms/v3/send";
    const token="e3d8dccc23900f6d19cd76bcd4f7b5157de6e7312335d2da81c258037bbef9b4";
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toAakash($notifiable);
        $data['auth_token']=self::token;
        $response = Http::post(self::url,$data);
        // Send notification to the $notifiable instance...
    }
}