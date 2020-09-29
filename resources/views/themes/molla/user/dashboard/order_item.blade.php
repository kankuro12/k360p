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

                    @php
                    $user = \App\model\VendorUser\VendorUser::where('user_id',Auth::user()->id)->first();
                    @endphp
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <div class="row">
                                    <table class="table table-cart table-mobile">
                                        <tr>
                                            <th>Product Detail</th>
                                            <th>Rate</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                        @php
                                            $simpletotal = 0;
                                            $varianttotal = 0;
                                        @endphp
                                        @foreach($orderItem as $item)
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
                                                           <small class="ml-4">--This product has not any attributes.</small>
                                                        @else
                                                        @php
                                                            $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                            foreach ($variant as $key => $v) {
                                                            echo '<small>'.$v['attribute']['name'].' :- '.$v['item']['name'].'</small><br>';
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
                                        </tr>
                                        @php
                                        if($item->product->stocktype == 1){
                                            $varianttotal = $varianttotal + $item->qty * $price->price;
                                            }else{
                                            $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                            }
                                        @endphp
                                        @endforeach
                                    </table>
                                </div>
                                        <div class="d-flex justify-content-end">
                                            <strong>Grand Total : </strong> <span > NPR.{{ $varianttotal + $simpletotal }}</span>
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