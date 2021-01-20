<div class=" text-center" style="border:1px solid #f1f1f1;">
    <figure class="product-media" >
        <a href="/product/{{ $product->product_id }}" style="margin: auto 0;display:flex;height:100%;">
            <img src="{{ asset($product->product_images) }}" alt="Product image" class="product-image" style="margin:auto;">
        </a>
    </figure><!-- End .product-media -->

    <div class="product-body px-1">
        <h3 class="product-title" style="font-size: 1.1rem; padding-top: 3px;"><a href="{{ route('product.detail', ['id'=>$product->product_id]) }}">{{ $product->product_name }}</a>
        </h3>
        <!-- End .product-title -->
        <div class="text-center"   style="font-size: 1.1rem; padding-top: 3px;">
            <span>

                @php
                    $onsale=$product->onSale();
                @endphp
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
                                {{ $product->mark_price }}</span></span>
                    @endif
                @else

                @endif
            </span>

        </div><!-- End .product-price -->

    </div><!-- End .product-body -->
</div><!-- End .product -->
