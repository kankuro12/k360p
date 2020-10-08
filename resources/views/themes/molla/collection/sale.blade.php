@extends('themes.molla.layouts.app')
@section('title','OnSale Product')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">OnSale Product<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Onsale</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">

            <div class="container featured mt-4 pb-2">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">Product On Sale</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                    <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="featured-women-link" data-toggle="tab" href="#featured-women-tab" role="tab" aria-controls="featured-women-tab" aria-selected="true">Product On Sale</a>
                            </li>
                        </ul>
                    </div><!-- End .heading-right -->
                </div><!-- End .heading -->
                <div class="row">
                    @foreach(\App\model\admin\Onsell::all() as $sell)
                    @php
                        $today = date('yy-m-d');
                        $startDate = date('yy-m-d',strtotime($sell->started_at));
                        $endDate = date('yy-m-d',strtotime($sell->end_at));
                    @endphp
                    @if($startDate<=$today && $endDate>=$today)
                        <div class="col-lg-9">
                            @if(!empty($sell->sell_product[0]))
                            <div class="heading-left">
                                <h2 class="title">{{ $sell->sell_name }} <span class="text-danger" style="font-size: 16px;">This sale available till ({{ $endDate }})</span></h2><!-- End .title -->
                            </div><!-- End .heading-left -->
                            <hr>
                            @endif

                            <div class="products mb-3">
                                <div class="row ">
                                    @php
                                        $sell_product = \App\model\admin\Sell_product::where('sell_id',$sell->sell_id)->take(4)->get();
                                        $sell_productCount = \App\model\admin\Sell_product::where('sell_id',$sell->sell_id)->count();
                                    @endphp
                                    @foreach($sell_product as $p)
                                        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    <span class="product-label label-new">On Sale</span>
                                                    <a href="{{ route('product.detail',$p->product_id)}}">
                                                        <img src="{{asset($p->product->product_images) }}" alt="Product image" class="product-image">
                                                    </a>

                                                    <div class="product-action-vertical">
                                                        <a href="{{ route('user.wishlist',$p->product_id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                                    </div><!-- End .product-action-vertical -->
                                                    <form action="{{ route('public.cart') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $p->product->product_id }}">
                                                        <input type="hidden" name="type" value="{{ $p->product->stocktype }}">
                                                        <input type="hidden" name="qty" value="1">
                                                        <input type="hidden" name="rate" value="{{ $p->product->mark_price }}">
                                                        <div class="product-action">
                                                            @if($p->product->stocktype == 0)
                                                            <button class="btn-product btn-cart" style="border: none;"><span>add to cart</span></button>
                                                            @else
                                                            <a href="{{ route('product.detail',$p->product->product_id) }}" class="btn-product btn-cart"><span>View Detail</span></a>
                                                            @endif
                                                        </div><!-- End .product-action -->
                                                    </form>
                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        <a href="#">{{ $p->product->category->cat_name }}</a>
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title"><a href="{{ route('product.detail',$p->product_id)}}">{{ $p->product->product_name }}</a></h3><!-- End .product-title -->
                                                    <div class="product-price">
                                                        @if($p->product->sell_price<$p->product->mark_price)
                                                            <span>NPR.{{ $p->product->sell_price }}</span> <span class="old-price ml-3">NPR.{{ $p->product->mark_price }}</span>
                                                            @else
                                                            <span>NPR.{{ $p->product->mark_price }}</span>
                                                            @endif
                                                    </div><!-- End .product-price -->
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-text">( 2 Reviews )</span>
                                                    </div><!-- End .rating-container -->

                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                    @endforeach
                                </div><!-- End .row -->
                                @if($sell_productCount >= 4)
                                <div class="load-more-container text-center">
                                    <a href="{{ route('public.sale.detail',$sell->sell_id) }}" class="btn btn-outline-darker btn-load-more">More Products <i class="icon-refresh"></i></a>
                                </div><!-- End .load-more-container -->
                                @endif
                            </div><!-- End .products -->
                        </div>
                        <div class="col-lg-3">
                        </div>
                        @endif
                        @endforeach
                        <div class="col-lg-3 order-md-first">
                            <div class="banner banner-overlay product-banner">
                                <a href="#">
                                    <img src="{{asset('themes/molla/assets/images/demos/demo-9/banners/banner-5.jpg') }}" alt="banner image">
                                </a>
                                <div class="banner-content">
                                    <div class="banner-top">
                                        <div class="banner-title text-white text-center">
                                            <i class="la la-star-o"></i>
                                            <h3 class="text-white">Our Experts<br>Recommend</h3>
                                        </div>
                                    </div>
                                    <div class="banner-bottom">
                                        <div class="product-cat">
                                            <h4 class="text-white">Sale</h4>
                                        </div>
                                        <div class="product-price">
                                            <h4 class="text-white">$29.99</h4>
                                        </div>
                                        <div class="product-txt">
                                            <p class="text-white">Wedge-heel sandals</p>
                                        </div>
                                        <a href="#" class="btn btn-outline-white banner-link">Shop Now</a>
                                    </div>
                                </div>
                            </div><!-- End .banner banner-overlay -->
                        </div><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div>

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main>
@endsection