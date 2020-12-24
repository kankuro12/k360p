<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class Aakash
{
    const url="https://aakashsms.com/admin/public/sms/v3/send";
    const token="0a8ae61597039acd1adf28e77173614e4ed88e9458a8a48151af51711af176af3";
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        // try {
            //code...
            $data = $notification->toAakash($notifiable);
            $data['auth_token']=self::token;
            $response = Http::post(self::url,$data);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        // Send notification to the $notifiable instance...
    }
}
