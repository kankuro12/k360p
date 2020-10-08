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
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs nav-tabs-bg justify-content-center" id="tabs-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tab-9-tab" data-toggle="tab" href="#tab-9" role="tab" aria-controls="tab-9" aria-selected="true">Pending</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-10-tab" data-toggle="tab" href="#tab-10" role="tab" aria-controls="tab-10" aria-selected="false">Accepted</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-11-tab" data-toggle="tab" href="#tab-11" role="tab" aria-controls="tab-11" aria-selected="false">On Delivery</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-12-tab" data-toggle="tab" href="#tab-12" role="tab" aria-controls="tab-12" aria-selected="false">PickUp</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-13-tab" data-toggle="tab" href="#tab-13" role="tab" aria-controls="tab-13" aria-selected="false">Delivered</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-14-tab" data-toggle="tab" href="#tab-14" role="tab" aria-controls="tab-14" aria-selected="false">Rejected</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab-15-tab" data-toggle="tab" href="#tab-15" role="tab" aria-controls="tab-15" aria-selected="false">Returned</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content tab-content-border p-4" id="tab-content-3">
                                            <div class="tab-pane fade show active" id="tab-9" role="tabpanel" aria-labelledby="tab-9-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 0)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->



                                            <div class="tab-pane fade" id="tab-10" role="tabpanel" aria-labelledby="tab-10-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 1)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->



                                            <div class="tab-pane fade" id="tab-11" role="tabpanel" aria-labelledby="tab-11-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 2)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->




                                            <div class="tab-pane fade" id="tab-12" role="tabpanel" aria-labelledby="tab-12-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 3)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->



                                            <div class="tab-pane fade" id="tab-13" role="tabpanel" aria-labelledby="tab-13-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 4)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->



                                            <div class="tab-pane fade" id="tab-14" role="tabpanel" aria-labelledby="tab-14-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 5)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->



                                            <div class="tab-pane fade" id="tab-15" role="tabpanel" aria-labelledby="tab-15-tab">
                                                <table class="table table-cart table-mobile">
                                                    <tbody>
                                                        <tr>
                                                            <th>Product Detail</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Total</th>
                                                            <TH class="text-right">Extra Feature</TH>
                                                        </tr>
                                                        @php
                                                        $simpletotal = 0;
                                                        $varianttotal = 0;
                                                        $totalCharge = 0;
                                                        $shippingCharge = 0;
                                                        $discount = 0;
                                                        @endphp
                                                        @foreach($orderItem as $item)
                                                        @if($item->stage == 6)
                                                        @php
                                                        $discount += $item->discount;
                                                        $shippingCharge += $item->shippingcharge;
                                                        $extraFeatureCount = \App\model\OrderItemCharge::where('order_item_id',$item->id)->count();
                                                        $extraFeature = \App\model\OrderItemCharge::where('order_item_id',$item->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a><br>
                                                                        @if($item->product->stocktype == 0)
                                                                        @else
                                                                        @php
                                                                        $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                        echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                        @endphp
                                                                        @endif
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            @php
                                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                            @endphp
                                                            @if($item->product->stocktype == 0)
                                                            <td class="price-col">NPR.{{ $item->product->sell_price }}</td>
                                                            @else
                                                            <td class="price-col">NPR.{{ $price->price }}</td>
                                                            @endif
                                                            <td class="quantity-col">
                                                                {{ $item->qty }}
                                                            </td>
                                                            @if($item->product->stocktype == 0)
                                                            <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
                                                            @else
                                                            <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
                                                            @endif
                                                            <td class="extra-feature">
                                                                @if($extraFeatureCount>0)
                                                                <ul class="text-right">
                                                                    @foreach($extraFeature as $key => $f)
                                                                    <li>{{ $f->title }} <span class="text-danger">(Rs.{{ $f->amount }})</span></li>
                                                                    @php
                                                                    $totalCharge = $totalCharge + $f->amount;
                                                                    @endphp
                                                                    @endforeach
                                                                </ul>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @php
                                                        if($item->product->stocktype == 1){
                                                        $varianttotal = $varianttotal + $item->qty * $price->price;
                                                        }else{
                                                        $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                        }
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end">
                                                    <span>Discount : </span> <strong class="ml-2"> NPR.({{ $discount }})</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span>Shipping Charge : </span> <strong class="ml-2"> NPR.{{ $shippingCharge }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <strong>Grand Total : </strong> <strong class="ml-2"> NPR.{{ $varianttotal + $simpletotal + $totalCharge + $shippingCharge - $discount }}</strong>
                                                </div>
                                            </div><!-- .End .tab-pane -->


                                        </div><!-- End .tab-content -->
                                    </div><!-- End .col-md-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection