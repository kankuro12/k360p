@extends('themes.molla.user.dashboard.app')
@section('title','Full Order Detail')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Full Order Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.account.profile') }}"><i class="zmdi zmdi-home"></i> User Dashboard </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Full Order Detail</li>
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
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <h5>Shipping Group - #{{ $orderItem[0]->shipping_detail_id }}</h5>
                                    <strong class="pb-5" style="color:#0acf21;">
                                        {{$orderItem[0]->created_at->diffForHumans()}}
                                    </strong>
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <p><strong>Name : </strong> {{ $orderItem[0]->shipping()->name }}</p>
                                    <p><strong>Address : </strong> {{ $orderItem[0]->shipping()->municipality->name }}, {{ $orderItem[0]->shipping()->district->name }}, {{ $orderItem[0]->shipping()->province->name }}</p>
                                    <p><strong>Email : </strong> {{ $orderItem[0]->shipping()->email }}</p>
                                    <p><strong>Phone : </strong> {{ $orderItem[0]->shipping()->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <td>Name</td>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Extra Feature</th>
                                    </tr>
                                </thead>
                                @php
                                $shippingCharge = 0;
                                $discount = 0;
                                $total = 0;
                                $totalCharge = 0;
                                @endphp
                                <tbody>
                                    @foreach($orderItem as $item)
                                    @php
                                    $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                    $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                    $total += $item->rate*$item->qty;
                                    $discount += $item->discount;
                                    $shippingCharge += $item->shippingcharge;
                                    @endphp
                                    <tr>
                                        <td>
                                            <img class="rounded avatar" src="{{ asset($item->product->product_images) }}" alt="Product Image">
                                        </td>
                                        <td>
                                            <a class="single-user-name" href="javascript:void(0);">{{ $item->product->product_name }}</a><br>
                                            <small>{{ $item->variant() }}</small>
                                        </td>
                                        <td>{{ $item->rate }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->rate * $item->qty }}</td>

                                        <td>
                                            @if($extraFeatureCount>0)
                                            @foreach($extraFeature as $f)
                                            <p>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span> </p>
                                            @php
                                            $totalCharge = $totalCharge + $f->amount;
                                            @endphp
                                            @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                <div class="text-right">
                                    <strong>Total :</strong> Rs.{{ $total }} <br>
                                    <strong>Extra Charge :</strong> Rs.{{ $totalCharge }} <br>
                                    <strong>Shipping Charge :</strong> Rs.{{ $shippingCharge }} <br>
                                    <strong>Discount :</strong> Rs.({{ $orderItem[0]->shipping()->discount }})
                                    <hr>
                                    <h5 class="mb-0 text-success"> Grand Total : Rs.{{ $total + $totalCharge + $shippingCharge - $orderItem[0]->shipping()->discount }}</h5>
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