<div class="tab-pane p-0 fade show {{$i==0?"active":""}}" id="boxeditems_{{ $item->id }}" role="tabpanel"
    aria-labelledby="trending-all-link">
    <div class="owl-carousel owl-full carousel-equal-height  cat-owl"  data-owl='{
        "responsive":{
            "0": {
                "items":1               
            },
            "480": {
                "items":{{$item->mobile}}
            },
            "768": {
                "items":{{$item->tab}}
            },
            "992": {
                "items":{{$item->tab}}
            },
            "1200": {
                "items":{{$item->laptop}}
            },
            "1600": {
                "items":{{$item->tv}}
            }
        }}'>

        @foreach ($item->products() as $product)
           
            <div class="product text-center" id="b_product_{{ $product->id }}">
                <figure class="product-media">
                    @if ($product->promo == 1)
                        <span class="product-label label-sale">Sale</span>
                    @endif
                    @if ($product->isnew())
                        <span class="product-label label-new">New</span>
                    @endif
                  
                    <a href="/product/{{ $product->product_id }}">
                        <img src="{{ asset($product->product_images) }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick
                                view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action text-center">

                        @if ($product->stocktype == 0)
                            <form action="{{ route('public.cart') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                <input type="hidden" name="type" value="{{ $product->stocktype }}">
                                <input type="hidden" name="qty" value="1">
                                <button class="btn-product btn-cart w-100"><span>add to cart</span></button>
                                <!-- <span onclick="javascript:this.form.submit();" class="btn-product btn-cart"><span>add to cart</span></span> -->
                            </form>
                        @else
                            <a href="{{ route('product.detail', $product->product_id) }}"
                                class="btn-product btn-cart "><span>View Detail</span></a>
                        @endif



                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">{{ $product->category->cat_name }}</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="/product/{{ $product->id }}">{{ $product->product_name }}</a>
                    </h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        @if ($product->stocktype == 0)
                            @if ($product->promo == 0)
                                Rs. {{ $product->mark_price }}
                            @else
                                <span class="new-price">Rs. {{ $product->sell_price }}</span>
                                <span class="old-price">Was Rs. {{ $product->mark_price }}</span>
                            @endif
                        @else
                        @endif

                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 4 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
        @endforeach
    </div><!-- End .owl-carousel -->
</div>
