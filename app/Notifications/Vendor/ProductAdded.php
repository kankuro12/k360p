<?php

namespace App\Notifications\Vendor;

use App\model\Vendor\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ProductAdded extends Notification
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
       
        $vendor=Vendor::find($notifiable->vendor_id);
        $vendor->url = route('admin.view-product',['id'=>$notifiable->product_id]);

        return (new SlackMessage)
                    ->success()
                    ->from('Laravel')
                    ->content('Vendor '.$vendor->name.' Has added a new Product')
                    ->attachment(function ($attachment) use ($vendor,$notifiable) {
                        $attachment->title('View Product', $vendor->url)
                                   ->fields([
                                        'Name' => $notifiable->product_name,
                                        'Type' =>$notifiable->stocktype==0?"single":"Variant" ,

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
}
