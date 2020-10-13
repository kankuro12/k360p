@extends('themes.molla.layouts.app')
@section('title','User Order Details')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Order<span>Detail</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">My Order</a></li>
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
                                                        <h5>Shipping Group - #{{ $orderItem->id }}</h5>
                                                        <tr>
                                                            <td>{{ $orderItem->shipping->name }}
                                                                <br>
                                                                <strong style="color:#0acf21;">
                                                                    {{$orderItem->created_at->diffForHumans()}}
                                                                </strong>
                                                            </td>
                                                            <td>{{ $orderItem->shipping->area->name }}, <br> {{ $orderItem->shipping->municipality->name }}, <br> {{ $orderItem->shipping->district->name }}, {{ $orderItem->shipping->province->name }} </td>
                                                            <td>{{ $orderItem->shipping->email }},<br>{{ $orderItem->shipping->phone }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @php 
                                                    $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$orderItem->id)->count();
                                                    $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$orderItem->id)->get();
                                                    $totalcharge = 0;
                                                @endphp
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($orderItem->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="#">{{ $orderItem->product->product_name }}</a> <br>
                                                                        <p>{{ $orderItem->variant() }}</p> 
                                                                        <strong>Delivery :</strong> @if($orderItem->deliverytype == 0)
                                                                                                        <span class="badge badge-primary">Simple</span>
                                                                                                    @else
                                                                                                       <span class="badge badge-success">Express</span>
                                                                                                    @endif


                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                                @if($extraFeatureCount>0)
                                                                <div class="mt-1">
                                                                    <h6>Extra Features & Charges</h6>
                                                                    @foreach($extraFeature as $key => $f)
                                                                        <p class="ml-3">{{ $key+1 }}. {{ $f->title}} <span class="text-danger">(Rs.{{ $f->amount }})</span></p>
                                                                        @php 
                                                                            $totalcharge += $f->amount;
                                                                        @endphp
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                            </td>
                                                            <td class="price-col" style="width: 30%;">Rate : {{ $orderItem->rate }} <br> Quantity : {{ $orderItem->qty }} <br>
                                                                <span class="total-col">Totat : {{ $orderItem->rate * $orderItem->qty }}</span> <br>
                                                                Extra Charge : {{ $totalcharge }} <br>
                                                                Shipping Charge : {{ $orderItem->shippingcharge }} <br>
                                                                Discount : ({{ $orderItem->discount }}) <hr>
                                                                <strong>Grand Total :</strong> NPR.{{ ($orderItem->rate*$orderItem->qty) + $orderItem->shippingcharge + $totalcharge - $orderItem->discount }}
                                                           </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                        
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