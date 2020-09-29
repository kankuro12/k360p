@extends('themes.molla.layouts.app')
@section('title','Shopping Cart')
@section('contant')
<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
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

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-9">
								<div style="margin:2rem 0;">
								    @include('themes.molla.layouts.message')
								</div>
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
									@php
										$simpletotal = 0;
										$varianttotal = 0;
                                    @endphp
									<tbody>
										@foreach($cartItem as $item)
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
											@if($item->product->stocktype == 0)
											   <td class="total-col">NPR.{{ $item->product->sell_price * $item->qty }} </td>
											@else
											   <td class="total-col">NPR.{{ $price->price * $item->qty }} </td>
											@endif
											<td class="remove-col"><a href="{{ url('remove/cart/item/'.$item->id) }}" class="btn-remove" title="Remove"><i class="icon-close"></i></a></td>
										</tr>
										@php
										    if($item->product->stocktype == 1){
												$varianttotal = $varianttotal + $item->qty * $price->price;
											}else{
												$simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
											}
                                        @endphp
										@endforeach
									</tbody>
								</table><!-- End .table table-wishlist -->

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
	                							<td>NPR.{{ $varianttotal + $simpletotal }}</td>
	                						</tr><!-- End .summary-subtotal -->
	                						
	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>NPR.{{ $varianttotal + $simpletotal }}</td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->
									<a href="{{ route('user.checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
	                				<a href="{{ route('guest.checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">CHECKOUT AS GUEST</a>
									
	                			</div><!-- End .summary -->

		            			<a href="{{ url('shops') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-lg-3 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection