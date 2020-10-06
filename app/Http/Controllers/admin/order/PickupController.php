<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\PickupPoint;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PickupController extends Controller
{
    //

    public function index()
    {
        $pickuppoints = PickupPoint::all();
        return view('admin.pickup.index', compact('pickuppoints'));
    }

    public function add(Request $request)
    {
        if ($request->method() == 'POST') {


            $user = new User([
                'email' => $request->email,
                'password' => bcrypt($request->password),


            ]);

            $user->role_id = 2;
            $user->active = 1;
            $user->activation_token = Str::random(8);
            $user->save();

            $point = new PickupPoint();
            $point->name = $request->name;
            $point->user_id = $user->id;
            $point->street_address = $request->address;
            $point->phone = $request->phone;
            $point->province_id = $request->province_id;
            $point->district_id = $request->district_id;
            $point->municipality_id = $request->municipality_id;
            $point->shipping_area_id = $request->shipping_area_id;
            $point->save();

            return redirect()->route('admin.pickup')->with('msg', "Pick Up Point Added Sucessfully");
        } else {
            return view('admin.pickup.add');
        }
    }

    public function edit(PickupPoint $point,Request $request)
    {
        if ($request->method() == 'POST') {

            $point->name = $request->name;
            $point->street_address = $request->address;
            $point->phone = $request->phone;
            $point->province_id = $request->province_id;
            $point->district_id = $request->district_id;
            $point->municipality_id = $request->municipality_id;
            $point->shipping_area_id = $request->shipping_area_id;
            $point->save();

            return redirect()->route('admin.manage-pickup',['point'=>$point->id])->with('msg', "Pick Up Point Updated Sucessfully");
        }
    }

    public function manage(PickupPoint $point){
        
        return view('admin.pickup.manage',compact('point'));
    }
}
