<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class Aakash
{
    const url="https://aakashsms.com/admin/public/sms/v3/send";
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            $data = $notification->toAakash($notifiable);
            $data['auth_token']=env('aakashsms',"");
            $response = Http::post(self::url,$data);
        } catch (\Throwable $th) {
            //throw $th;
        }
        // Send notification to the $notifiable instance...
    }

    public static function sendMessage($data){
        $data['auth_token']=env('aakashsms',"");
        $response = Http::post(self::url,$data);
        return $response->body();
    }
}
