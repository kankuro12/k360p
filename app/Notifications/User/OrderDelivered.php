<?php

namespace App\Notifications\User;

use App\Channels\Aakash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderDelivered extends Notification
{
    use Queueable;

    protected $ids;
    protected $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($_ids,$_name)
    {
        $this->ids=$_ids;
        $this->name=$_name;
      
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        
        return ['mail',OneSignalChannel::class];
        
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $shipping=$notifiable;
        return (new MailMessage)->subject('Order Delivered')
                    ->line("Your Orders ".$text."\n Has Been Deleivered via ".$this->name)
                    ->action('View Your Dashboard', route('user.order.item',['id'=>$shipping->id]))
                    ->line('Thank you for using '.env('APP_NAME','laravel').'!!');
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
            ->setSubject("Order Delivered")
            ->setBody("Your Orders ".$text."\n Has Been Delivered Via ".$this->name. '. Thank you for using '.env('APP_NAME','laravel').'!!')
            ->setUrl(route('user.order.item',['id'=>$shipping->id]));
            return $data;
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
