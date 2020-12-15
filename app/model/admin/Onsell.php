<?php

namespace App\model\admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Onsell extends Model
{

    protected $casts = [
        'end_at' => 'datetime',
    ];
    //
    protected $primaryKey = 'sell_id';

    public function sell_product()
    {
        return $this->hasMany(Sell_product::class, 'sell_id');
    }

    public function time()
    {
        $start  = Carbon::now();
        $end    = new Carbon($this->end_at);
        $data = $start->diff($end);
        $data1 = $data->format('+%Yy %Mm %Dd %Hh %Im %Ss');;
        return $data1;
    }

    public function menuItems(){
        return Sell_product::where('sell_id',$this->sell_id)->inRandomOrder()->limit(6)->get();
    }
}
