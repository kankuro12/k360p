<div class="product product-list">
    <div class="row">
        <div class="col-6 col-lg-3">
            <figure class="product-media">
                @php
                $onsale=$product->onSale();
                @endphp
                @if ($product->promo == 1 || $onsale)
                    @if ($onsale)
                        @php
                        $sellproduct=$product->sale();
                        $sell=$sellproduct->onsale;
                        @endphp
                        <span class="product-label label-sale">
                            <a href="{{ route('public.sale.detail', $sell->sell_id) }}"
                                style="color:white;font-weight: 400">
                                {{ $sell->sell_name }} <span class="ml-2">- {{ $sellproduct->sale_discount }}%</span>
                            </a>
                        </span>
                    @else
                        <span class="product-label label-sale">sale</span>

                    @endif

                @endif
                @if ($product->isnew())
                    <span class="product-label label-new"><a href="{{route('latest')}}" style="color:white;"> New </a></span>

                @endif
                @if ($product->isTop())
                    <span class="product-label label-top">Top</span>
                @endif
                <a href="/product/{{ $product->product_id }}">
                    <img src="{{ asset($product->product_images) }}" alt="Product image" class="product-image">
                </a>
            </figure><!-- End .product-media -->
        </div><!-- End .col-sm-6 col-lg-3 -->

        <div class="col-6 col-lg-3 order-lg-last">
            <div class="product-list-action">
                <div class="product-price">
                    @if ($product->stocktype == 0)
                        @if ($product->promo == 0 && !$onsale)
                            Rs. {{ $product->mark_price }}
                        @else
                            @if ($onsale)
                                <span class="new-price">Rs. {{ $product->salePrice() }} </span>
                            @else
                                <span class="new-price">Rs. {{ $product->sell_price }} </span>
                            @endif
                            <span class="old-price">Was <span style="text-decoration: line-through;">Rs.
                                    {{ $product->mark_price }}</span> </span>
                        @endif
                    @else

                    @endif

                </div><!-- End .product-price -->
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: {{$product->avgRating()}}%;"></div><!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( {{$product->reviewCount()}} Reviews )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-quickview" style="border: none;
                    background: transparent;" title="Quick view"><span>quick
                            view</span></a>
                    <a href="#" class="btn-product btn-compare" style="border: none;
                    background: transparent;" title="Compare"><span>compare</span></a>

                </div><!-- End .product-action -->
                <div class="product-action">
                    <a href="{{ route('user.wishlist', $product->product_id) }}" class="btn-product btn-wishlist"
                        title="Add to wishlist"
                        style="width:100%;text-align:center;background:none;border:none;"><span>add to
                            wishlist</span></a>


                </div><!-- End .product-action -->

                <div class="product-action text-center">

                    @if ($product->stocktype == 0)
                        @if ($product->quantity>0)
                        <form action="{{ route('public.cart') }}" method="POST" class="w-100">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="type" value="{{ $product->stocktype }}">
                            <input type="hidden" name="qty" value="1">
                            @if ($product->promo == 0 && !$onsale)

                                <input type="hidden" name="rate" value="{{ $product->mark_price }}">

                            @else
                                @if ($onsale)
                                    <input type="hidden" name="rate" value="{{ $product->salePrice() }}">
                                @else
                                    <input type="hidden" name="rate" value="{{ $product->$product->sell_price() }}">
                                @endif
                            @endif

                            <button class="btn-product btn-cart w-100" style="color:white;"><span>add to
                                    cart</span></button>
                            <!-- <span onclick="javascript:this.form.submit();" class="btn-product btn-cart"><span>add to cart</span></span> -->
                        </form>
                        @else
                            <button class="btn-product btn-cart w-100"><span>Out Of Stock</span></button>

                        @endif
                    @else
                        <a href="{{ route('product.detail', $product->product_id) }}" class="btn-product btn-cart "
                            style="color:white;"><span>View Detail</span></a>
                    @endif



                </div><!-- End .product-action -->
            </div><!-- End .product-list-action -->
        </div><!-- End .col-sm-6 col-lg-3 -->

        <div class="col-lg-6">
            <div class="product-body product-action-inner">

                <div class="product-cat">
                    <a href="{{route('shop-by-category',['id'=>$product->category->cat_id])}}">{{$product->category->cat_name}}</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="/product/{{ $product->product_id }}">{{ $product->product_name }}</a>
                </h3>
                <!-- End .product-title -->

                <div class="product-content">
                    <p>{!! $product->product_short_description !!}</p>
                </div><!-- End .product-content -->

                <div class="product-nav product-nav-thumbs">
                    @foreach ($product->images as $productimage)
                        <a href="#" class="prod-thumb-btn" style="border: none">
                            <img src="{{ asset($productimage->image) }}" data-img="{{ asset($productimage->image) }}"
                                data-zoom_img="{{ asset($productimage->image) }}">
                        </a>
                    @endforeach
                </div><!-- End .product-nav -->
            </div><!-- End .product-body -->
        </div><!-- End .col-lg-6 -->
    </div><!-- End .row -->
</div><!-- End .product -->
