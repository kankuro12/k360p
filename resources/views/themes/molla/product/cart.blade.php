@extends('themes.molla.layouts.app')
@section('title','Shopping Cart')
@section('contant')
<main class="main">
    <div class="mobile-header d-flex d-md-none text-white hasbackground" >
        <span>
            <button style="background: none;outline:none;border:none;padding:5px;color:white;font-size:2rem;" onclick="goBack();"> < </button>
        </span>
        <span style="flex-grow:1;max-width:270px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;padding:8px 5px;">
            My Cart
        </span>
    </div>
    <div class="{{env('enable_mobile_header',1)==1?"d-none d-md-block":""}}">
        	<div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
    </div>
            <div class="page-content  {{env('enable_mobile_header',1)==1?"mt-5 mt-md-0 pt-1 pt-md-0":""}}">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-9">
								<div style="margin:2rem 0;">
								    @include('themes.molla.layouts.message')
                                </div>
                                <div class="d-none d-md-block">

                                    <table class="table table-cart table-mobile ">
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
                                        @php
                                            $simpletotal = 0;
                                            $varianttotal = 0;
                                            $totalCharge = 0;
                                            $extra = 0;
                                        @endphp
                                        <tbody>
                                            @foreach($cartItem as $item)
                                             @php
                                                $extraFeatureCount = \App\ExatraChargeCart::where('cart_id',$item->id)->count();
                                                $extraFeature = \App\ExatraChargeCart::where('cart_id',$item->id)->get();
                                             @endphp
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="{{ route('product.detail',$item->product_id) }}">
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


                                                <td class="price-col">NPR. {{ $item->rate+0 }}</td>

                                                <td class="quantity-col">
                                                    <div class="text-center">
                                                        <a href="{{ url('cart/update-qty/'.$item->id.'/1') }}" class="badge badge-secondary p-2">+</a>
                                                        <div style="margin-top:3px;">
                                                            <input type="text" class="text-center" disabled="disabled" value="{{ $item->qty }}" min="1" max="5" step="1" data-decimals="0" style="width:40px; height:25px;">
                                                        </div>
                                                        @if ($item->qty > 1)
                                                            <a href="{{ url('cart/update-qty/'.$item->id.'/-1') }}" class="badge badge-secondary p-2">-</a>
                                                        @endif
                                                    </div>
                                                </td>

                                                @php
                                                    $totalCharge+=$item->rate * $item->qty ;
                                                @endphp
                                                   <td class="total-col">NPR. {{ $item->rate * $item->qty }} </td>

                                                <td class="extra-feature">
                                                    @if($extraFeatureCount>0)
                                                        @foreach($extraFeature as $f)
                                                            <p>{{ $f->title }}  <span class="text-danger">(Rs.{{ $f->amount }})</span><a href="{{ url('remove/feature/item/'.$f->id) }}" class="btn-remove" title="Remove Feature"><i class="icon-close"></i></a> </p>
                                                            @php
                                                               $extra += $f->amount;
                                                            @endphp
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="remove-col"><a href="{{ url('remove/cart/item/'.$item->id) }}" class="btn-remove" title="Remove"><i class="icon-close"></i></a></td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table><!-- End .table table-wishlist -->
                                </div>
                                <div class="d-block d-md-none">
                                    @foreach($cartItem as $item)
                                        <div class="card shadow mb-2" style="position: relative;">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{ route('product.detail',$item->product_id) }}">
                                                        <img src="{{ asset($item->product->product_images) }}" alt="Product image">
                                                    </a>
                                                </div>
                                                <div class="col-6 p-0 py-1">
                                                    <div style="font-size:1rem;font-weight:600;max-width: calc(100% - 50px);">
                                                        <a href="{{ route('product.detail',$item->product_id) }}" style="">{{ $item->product->product_name }}</a>
                                                        @if($item->product->stocktype == 0)
                                                            @else
                                                                @php
                                                                    $variant = \App\Setting\VariantManager::codeToString($item->variant_code);
                                                                        foreach ($variant as $key => $v) {
                                                                            echo '<small>'.$v['attribute']['name'].' : '.$v['item']['name'].'</small><br>';
                                                                        }
                                                                @endphp
                                                            @endif
                                                    </div>
                                                    <div style="font-size:0.9rem;font-weight:500;">
                                                        NPR. {{ $item->rate+0 }}
                                                    </div>
                                                    <div style="font-size:0.9rem;font-weight:500;">
                                                        <div class="d-flex">
                                                            <a href="{{ url('cart/update-qty/'.$item->id.'/1') }}" class="badge badge-secondary p-3">+</a>
                                                            <div style="margin-top:3px; display:inline;flex-grow:1;max-width:90px;padding:0px 5px;">
                                                                <input type="text" class="text-center" disabled="disabled" value="{{ $item->qty }}" min="1" max="5" step="1" data-decimals="0" style="width:100%;;">
                                                            </div>
                                                            @if ($item->qty > 1)
                                                                <a href="{{ url('cart/update-qty/'.$item->id.'/-1') }}" class="badge badge-secondary p-3">-</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if($extraFeatureCount>0)
                                                        <div style="font-size:0.9rem;font-weight:500;">
                                                            NPR. {{ $item->rate+0 }}
                                                            @foreach($extraFeature as $f)
                                                                <p>{{ $f->title }}  <span class="text-danger">(Rs.{{ $f->amount }})</span><a href="{{ url('remove/feature/item/'.$f->id) }}" class="btn-remove" title="Remove Feature"><i class="icon-close"></i></a> </p>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <div style="position: absolute;top:-10px;right:5px;border-radius: 50%;background:rgb(136, 0, 0);">
                                                        <a href="{{ url('remove/cart/item/'.$item->id) }}" class="btn-remove" title="Remove" style="color:white !important;"><i class="icon-close"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

	                			<div class="cart-bottom">
			            			<div class="cart-discount">
			            				<form action="{{ route('apply.coupon') }}" method="POST">
											@csrf
			            					<div class="input-group">
				        						<input type="text" class="form-control" name="coupon_code" required placeholder="coupon code">
				        						<div class="input-group-append">
													<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
												</div><!-- .End .input-group-append -->
			        						</div><!-- End .input-group -->
			            				</form>
			            			</div><!-- End .cart-discount -->
		            			</div><!-- End .cart-bottom -->
	                		</div><!-- End .col-lg-9 -->
	                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">
	                							<td>Subtotal:</td>
	                							<td>NPR.{{ $totalCharge }}</td>
											</tr><!-- End .summary-subtotal -->

											@if($totalCharge>0)
											<tr class="summary-subtotal">
	                							<td>Extra Feature Charge:</td>
	                							<td>NPR.{{ $extra }}</td>
											</tr><!-- End .summary-subtotal -->
											@endif
											@php
												$discount=Session::get('couponAmount', 0);
											@endphp
											@if($discount>0)
											<tr class="summary-subtotal">
	                							<td>coupon Discount:</td>
	                							<td>NPR.{{ $discount }}</td>
											</tr><!-- End .summary-subtotal -->
											@endif


	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>NPR.{{  $extra + $totalCharge - $discount}}</td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->
									<a href="{{ route('user.checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
									@if(!Auth::check())
	                				<a href="{{ route('guest.checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">CHECKOUT AS GUEST</a>
									@endif
	                			</div><!-- End .summary -->

		            			<a href="{{ url('shops') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-lg-3 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
