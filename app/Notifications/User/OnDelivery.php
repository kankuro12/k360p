<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OnDelivery extends Notification
{
    use Queueable;


    protected $ids;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($_ids)
    {
        $this->ids=$_ids;
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

    public function toOneSignal($notifiable)
    {
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $shipping=$notifiable;
        // dd($shipping);
        $data= OneSignalMessage::create()
            ->setSubject("A New Order Added")
            ->setBody("Your Orders ".$text."\n Are On Delivery.\nCheck Your Account\n.")
            ->setUrl(route('user.order.item',['id'=>$shipping->id]));
            return $data;
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
