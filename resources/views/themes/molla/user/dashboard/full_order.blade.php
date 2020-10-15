@extends('themes.molla.layouts.app')
@section('title','User Full Order Details')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Full Order<span>Detail</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Full Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('themes.molla.user.dashboard.header')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-order" role="tabpanel" aria-labelledby="tab-order-link">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <h5>Shipping Group - #{{ $orderItem[0]->shipping_detail_id }}</h5>
                                                        <tr>
                                                            <td>{{ $orderItem[0]->shipping()->name }}
                                                                <br>
                                                                <strong style="color:#0acf21;">
                                                                    {{$orderItem[0]->created_at->diffForHumans()}}
                                                                </strong>
                                                            </td>
                                                            <td>{{ $orderItem[0]->shipping()->area->name }}, <br> {{ $orderItem[0]->shipping()->municipality->name }}, <br> {{ $orderItem[0]->shipping()->district->name }}, {{ $orderItem[0]->shipping()->province->name }} </td>
                                                            <td>{{ $orderItem[0]->shipping()->email }},<br>{{ $orderItem[0]->shipping()->phone }}</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @php 
                                                    $shippingCharge = 0;
                                                    $discount = 0;
                                                    $total = 0;
                                                    $totalCharge = 0;
                                                @endphp
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>
                                                            <th>Extra Feature</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        <p>{{ $item->variant() }}</p>
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            <td>{{ $item->rate }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>{{ $item->rate * $item->qty }}</td>
                                                            <td>
                                                                @if($extraFeatureCount>0)
                                                                    @foreach($extraFeature as $f)
                                                                        <p>{{ $f->title }}  <span class="text-danger">(Rs.{{ $f->amount }})</span> </p>
                                                                        @php 
                                                                        $totalCharge = $totalCharge + $f->amount;
                                                                        @endphp 
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table><!-- End .table table-wishlist -->
                                                    <div class="text-right">
                                                        <strong>Total :</strong> {{ $total }} <br>
                                                        <strong>Extra Charge :</strong> {{ $totalCharge }} <br>
                                                        <strong>Shipping Charge :</strong> {{ $shippingCharge }} <br>
                                                        <strong>Discount :</strong> ({{ $discount }})
                                                        <hr>
                                                        <strong>Grand Total : </strong> <strong>NPR. {{ $total + $totalCharge + $shippingCharge - $discount }}</strong>
                                                    </div>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection