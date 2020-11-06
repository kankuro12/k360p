@extends('themes.molla.user.dashboard.app')
@section('title','Order Detail')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Order Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.account') }}"><i class="zmdi zmdi-home"></i> User Dashboard </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Order Detail</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            @php
                            $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$orderItem->id)->count();
                            $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$orderItem->id)->get();
                            $totalcharge = 0;
                            $gallery = \App\model\admin\Product_image::where('product_id',$orderItem->product->product_id)->get();
                        
                            @endphp
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-12">
                                    <div class="preview preview-pic tab-content">
                                        <div class="tab-pane active show" id="product_4"><img src="{{asset($orderItem->product->product_images) }}" class="img-fluid" alt=""></div>
                                    </div>
                                    <ul class="preview thumbnail nav nav-tabs">
                                        @foreach($gallery as $g)
                                           <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#product_4"><img src="{{asset($g->image)}}" alt=""></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-xl-9 col-lg-8 col-md-12">
                                    <div class="product details">
                                        <h3 class="product-title mb-0">{{ $orderItem->product->product_name }}</h3>
                                        <h5 class="price mt-0">Product Price : <span class="col-amber">Rs.{{ $orderItem->rate }}</span></h5>
                                        <p>{{ $orderItem->variant() }}</p>
                                        <strong>Delivery :</strong> @if($orderItem->deliverytype == 0)
                                        <span class="badge badge-primary">Simple</span>
                                        @else
                                        <span class="badge badge-success">Express</span>
                                        @endif

                                        @if($extraFeatureCount>0)
                                        <hr>
                                            <div class="mt-1">
                                                <h6>Extra Features & Charges</h6>
                                                @foreach($extraFeature as $key => $f)
                                                <p class="ml-3">{{ $key+1 }}. {{ $f->title}} <span class="text-danger">(Rs.{{ $f->amount }})</span></p>
                                                @php
                                                $totalcharge += $f->amount;
                                                @endphp
                                                @endforeach
                                            </div>
                                        <hr>
                                        @endif


                                        <p > <strong> Quantity  : </strong>{{ $orderItem->qty }} <br>
                                            <strong>Totat : </strong>Rs.{{ $orderItem->rate * $orderItem->qty }} <br>
                                            <strong> Extra Charge : </strong> Rs.{{ $totalcharge }} <br>
                                            <strong>  Shipping Charge : </strong> Rs.{{ $orderItem->shippingcharge }} <br>
                                             <strong>Discount : </strong>Rs.({{ $orderItem->discount }})
                                            <hr>
                                            <h5 class="text-success">Grand Total : Rs.{{ ($orderItem->rate*$orderItem->qty) + $orderItem->shippingcharge + $totalcharge - $orderItem->discount }}</h5>
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <h5>Shipping Group - #{{ $orderItem->id }}, </h5>
                                    <strong class="pb-5" style="color:#0acf21;">
                                        {{$orderItem->created_at->diffForHumans()}}
                                    </strong>
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <p><strong>Name : </strong> {{ $orderItem->shipping()->name }}</p>
                                    <p><strong>Address : </strong> {{ $orderItem->shipping()->area->name }}, {{ $orderItem->shipping()->municipality->name }}, {{ $orderItem->shipping()->district->name }}, {{ $orderItem->shipping()->province->name }}</p>
                                    <p><strong>Email : </strong> {{ $orderItem->shipping()->email }}</p>
                                    <p><strong>Phone : </strong> {{ $orderItem->shipping()->phone }}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection