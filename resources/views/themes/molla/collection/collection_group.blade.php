@extends('themes.molla.layouts.app')
@section('title','Collection Group')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Collection Group<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.collection') }}">Collection</a></li>
                <li class="breadcrumb-item"><a href="#">Group</a></li>
                <li class="breadcrumb-item active" aria-current="page">@if(!empty($collection_group[0])) {{ $collection_group[0]->collection->collection_name }} @endif</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
           
            <div class="products">
                <div class="row">
                    @foreach($collection_group as $p)

                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="product">
                            <figure class="product-media">
                                <span class="product-label label-new">New</span>
                                <a href="{{ route('product.detail',$p->product->product_id) }}">
                                    <img src="{{ asset($p->product->product_images) }}" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="{{ route('user.wishlist',$p->product_id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                </div><!-- End .product-action -->
                                <form action="{{ route('public.cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $p->product->product_id }}">
                                    <input type="hidden" name="type" value="{{ $p->product->stocktype }}">
                                    <input type="hidden" name="qty" value="1">
                                    <div class="product-action action-icon-top">
                                        @if($p->product->stocktype == 0)
                                        <button class="btn-product btn-cart" style="border: none; background:white;"><span>add to cart</span></button>
                                        <!-- <span onclick="javascript:this.form.submit();" class="btn-product btn-cart"><span>add to cart</span></span> -->
                                        @else
                                        <a href="{{ route('product.detail',$p->product->product_id) }}" class="btn-product btn-cart"><span>View Detail</span></a>
                                        @endif
                                        <a href="#" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                        <a href="#" class="btn-product btn-compare" title="Compare"><span>compare</span></a>
                                    </div><!-- End .product-action -->
                                </form>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $p->product->category->cat_name }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{ route('product.detail',$p->product->product_id) }}">{{ $p->product->product_name }}</a></h3><!-- End .product-title -->
                               
                                <div class="product-price">
                                   NPR.{{ $p->product->mark_price }}
                                </div>

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 0 Reviews )</span>
                                </div><!-- End .rating-container -->

                               
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    @endforeach

                </div><!-- End .row -->
            </div><!-- End .products -->

           
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection