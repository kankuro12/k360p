<?php

namespace App\Notifications\User;

use App\Channels\Aakash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderPickup extends Notification
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
        if(env('orderpickup',0)==1){

            return ['mail',Aakash::class,OneSignalChannel::class];
        }else{
            return ['mail',OneSignalChannel::class];
        }
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
        return (new MailMessage)->subject('Order Arrived At Pickup Point')
                    ->line("Your Orders ".$text."\n Has Arrived at ".$this->name.". Please Pickup Your Package.")
                    ->action('View Your Dashboard', route('user.order.item',['id'=>$shipping->id]))
                    ->line('Thank you for using '.env('APP_NAME','laravel').'!!');
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


    public function toOneSignal($notifiable)
    {
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $shipping=$notifiable;
        // dd($shipping);
        $data= OneSignalMessage::create()
            ->setSubject("Please Pick Up Your Order")
            ->setBody("Your Orders ".$text."\n Has Arrived at ".$this->name.". Please Pickup Your Package.")
            ->setUrl(route('user.order.item',['id'=>$shipping->id]));
            return $data;
    }

    public function toAakash($notifiable){
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        return ['to'=>$notifiable->phone,"text"=>"Your Orders ".$text."\n Has Arrived at ".$this->name.". Please Pickup Your Package."];
    }
}
