<?php

namespace App\Notifications\Vendor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SetupFinished extends Notification
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
        return ['slack'];
    }


    public function toSlack($notifiable)
    {
       
        $vendor=$notifiable->vendor;
        $vendor->url = route('admin.vendor-details',['id'=>$notifiable->id]);

        return (new SlackMessage)
                    ->success()
                    ->from('Laravel')
                    ->content('A New Vendor Has Submitted Document for Verification')
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
}
