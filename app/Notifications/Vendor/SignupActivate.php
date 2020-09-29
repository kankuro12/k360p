<?php

namespace App\Notifications\Vendor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Channels\Aakash;
class SignupActivate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack',Aakash::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
//        return (new MailMessage)
//            ->subject('Confirm your account')
//            ->line('Thanks for signup! Please before you begin, you must confirm your account.')
//            ->action('Confirm Account', url($url))
//            ->line('Thank you for using our application!');

        return (new MailMessage)->subject('Confirm your account!!!')->view(
            'email.vendors.activate',['token'=>$notifiable->activation_token]
        );
    }

    public function toSlack($notifiable)
    {
       
        $vendor=$notifiable->vendor;
        $vendor->url = 'http://192.168.100.101:8000/admin/vendor-details/'.$notifiable->id;

        return (new SlackMessage)
                    ->success()
                    ->from('Laravel')
                    ->content('A New Vendor Has Been Registered')
                    ->attachment(function ($attachment) use ($vendor,$notifiable) {
                        $attachment->title('View Detail', $vendor->url)
                                   ->fields([
                                        'Name' => $vendor->name,
                                        'Email' =>$notifiable->email ,
                                        'Phone' => $vendor->phone_number,
                                        
                                    ]);
                    });
            
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toAakash($notifiable){
        $vendor=$notifiable->vendor;
        
        return ['to'=>$vendor->phone_number,"text"=>"Your Activation Code is ".$notifiable->activation_token];
    }
}
