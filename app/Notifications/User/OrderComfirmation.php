<?php

namespace App\Notifications\User;

use App\Channels\Aakash;
use App\model\OrderItem;
use App\model\ShippingDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderComfirmation extends Notification
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
        return ['mail',Aakash::class,OneSignalMessage::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
    

        $shipping=$notifiable;
        $orders=OrderItem::whereIn('id',$this->ids)->get();

        return (new MailMessage)->subject('Order Comfirmed')->view(
            'email.order.receipt',
            ['shipping' => $shipping,'orders'=>$orders]
        );
    }

    public function toOneSignal($notifiable)
    {
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
        $shipping=$notifiable;
        return OneSignalMessage::create()
            ->setSubject("A New Order Added")
            ->setBody("Your Orders ".$text."\n Has Been Approved.\nCheck Your Account\n.")
            ->setUrl(route('user.order.item',['id'=>$shipping->id]));
    }

    public function toAakash($notifiable){
        $text='';
        for ($i=0; $i < count($this->ids); $i++) { 
           $text.="\n".($i+1). ". #".$this->ids[$i];
        }
     

        return ['to'=>$notifiable->phone,"text"=>"Your Orders ".$text."\n Has Been Approved.\nCheck Your Account\n-".env('APP_NAME','laravel')];
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
