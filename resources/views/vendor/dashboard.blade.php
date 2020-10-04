@extends('layouts.sellerlayouts.seller-design')
@section('content')
    <style>
        .card-alert {

            background-color: #f55a4e;
            color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4)
        }

        .card-info {
            background-color: #00bcd4;
            color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4);
        }

        .text-white {
            color: #ffffff;
        }

    </style>

    @if ($data->verified == 0)
        @php
            $verification=\App\VendorVerification::where('vendor_id', $data->id)->first();
        @endphp
        @if ($verification==null)
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-alert">
                        <div class="card-header color-white">
                            <h4 class="card-title">
                                <strong class="text-white">
                                    Verification Detail Not Found.
                                </strong>
                            </h4>

                        </div>
                        <div class="card-header">
                            <a href="{{route('vendor.verification')}}" style="color: white;text-decoration: underline;">Click Here To Add Verification Details..</a>
                        </div>
                        <br>
                    </div>


                </div>


            </div>
       
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-alert">
                    <div class="card-header color-white">
                        <h4 class="card-title">
                            <strong class="text-white">
                                Account Not Verified
                            </strong>
                        </h4>

                    </div>
                    <div class="card-header">
                        You Account Has Not Been Verified.
                    </div>
                    <br>
                </div>


            </div>


        </div>
    @else
        <div class="container-fluid">
            <div class="row">    
                
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Products</p>
                            <h3 class="card-title">{{ $productcount }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('vendor.manage-product')}}">
                                    <i class="material-icons">local_offer</i> All Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Verified Products</p>
                            <h3 class="card-title">{{ $verifiedcount }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('vendor.manage-product')}}">
                                    <i class="material-icons">local_offer</i> All Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="red">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Unverified Products</p>
                            <h3 class="card-title">{{ $unverifiedcount }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('vendor.manage-product')}}">
                                    <i class="material-icons">local_offer</i> All Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="brown">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Featured Products</p>
                            <h3 class="card-title">{{ $featuredcount }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('vendor.manage-product')}}">
                                    <i class="material-icons">local_offer</i> All Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="purple">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Coupons</p>
                            <h3 class="card-title">{{ $couponcount }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('vendor.manage-coupon')}}">
                                    <i class="material-icons">local_offer</i> All Coupons
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>


        <div class="container-fluid">

            <div class="row equal">
                <div class="col-md-4" style="height: 100%">
                    <div class="card" style="height: 100%">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title"> <strong>Order Statistics</strong> </h4>
                        </div>
                        <hr style="margin-bottom: 0;">
                        <div class="card-body" style="padding:1.5rem;">
                              <table class="table">
                                @for ($i = 0; $i < 7; $i++)
                                    <tr>
                                       
                                        <td>
                                            <a href="{{route('vendor.orders',['status'=>$i])}}">
                                                <i class="material-icons">{{\App\Setting\OrderManager::stageicons[$i]}}</i> {{\App\Setting\OrderManager::stages[$i]}} orders
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <strong>
                                                {{App\model\OrderItem::where('vendor_id',$data->id)->where('stage',$i)->count()}}
                                            </strong>
                                        </td>
                                    </tr>
                                @endfor
                              </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" >
                        <div class="card-header card-header-danger">
                            <h4 class="card-title"> 
                                <strong>Latest Orders</strong> -  
                                <strong>
                                    <a href="{{route('vendor.orders',['status'=>0])}}">View Orders</a>
                                </strong>
                            </h4>
                        </div>
                        <hr style="margin-bottom: 0;">
                        <div class="card-body" style="padding:1.5rem;">
                              <table class="table">
                                  <tr>
                                      <th style="border: none;">
                                          Product
                                      </th>
                                      <th style="border: none;">
                                          Quantity
                                      </th>
                                      <th style="border: none;">
                                          Attributes
                                      </th>
                                      <th style="border: none;">
        
                                      </th>
                                  </tr>
                                @foreach ($latest as $order)
                                    @php
                                        $product=$order->product;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{$product->product_name}}
                                            <br>
                                            <strong style="color:#0acf21;">
                                                {{$order->created_at->diffForHumans()}}
                                            </strong>
                                        </td>
                                        <td>
                                            {{$order->qty}} Pcs
                                        </td>
                                        <td>
                                            {{ $order->variant() }}
                                        </td>
                                        <td>
                                            <div>
                                                {{\App\Setting\OrderManager::stages[$order->stage]}} 
                                            </div>
                                            <div>
        
                                                <strong>
                                                    <a href="{{Route('admin.orders-flash',['status'=>$order->stage,'id'=>$order->shipping_detail_id])}}">Detail</a>
                                                </strong>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($data->islaunched==0)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-alert">
                <div class="card-header color-white">
                    <h4 class="card-title">
                        <strong class="text-white">
                            You store is in Draft Mode. Publish you Store to Make it visible to customers.
                        </strong>
                    </h4>

                </div>
                <div class="card-header">
                    <a href="{{route('vendor.launch')}}" style="color: white;text-decoration: underline;">Click Here To Publish Your Store</a>
                </div>
                <br>
            </div>


        </div>


    </div>
    @endif
    

@endsection
