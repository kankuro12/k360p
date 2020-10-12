<?php

namespace App\Notifications\Vendor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class ProductAccepted extends Notification
{
    use Queueable;


    protected $product_id;
    protected $product_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pid,$pname)
    {
        $this->product_id=$pid;
        $this->product_name=$pname;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable){
        return OneSignalMessage::create()
            ->setSubject("Message From ".env('APP_NAME',"laravel"))
            ->setBody("Your Product ". $this->product_name ." Has Been Verified.")
            ->setUrl(route('vendor.view-product',['id'=>$this->product_id]));
          
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
