@extends('themes.molla.layouts.app')
@section('title', 'Product Detail')
@section('css')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('themes/molla/assets/css/simple-rating.css') }}">
@endsection
@section('meta')
    <meta property="og:url"           content="{{route('product.detail',['id'=>$product->product_id])}}" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="{{$product->product_name}}" />
    <meta property="og:description"   content="{{ $product->product_short_description }}" />
    <meta property="og:image"         content="{{ asset($product->product_images) }}" />
@endsection
@section('contant')
<div class="mobile-header d-flex d-md-none text-white hasbackground" >
    <span>
        <button style="background: none;outline:none;border:none;padding:5px;color:white;font-size:2rem;" onclick="goBack();"> < </button>
    </span>
    <span style="flex-grow:1;max-width:270px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;padding:8px 5px;">
        {{$product->product_name}}
    </span>
</div>

    <main class="main">
        <div class="page-header text-center d-none d-md-block"
            style="background-image: url({{ asset('themes/molla/assets/images/page-header-bg.jpg') }})">
            <div class="container">
                <h1 class="page-title">Single Product<span>Detail</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2 d-none d-md-block">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Single Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content pt-md-0 pt-5 mt-1 mt-md-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-details-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-gallery">
                                        <figure class="product-main-image">
                                            <!-- <span class="product-label label-top">Top</span> -->
                                            <img id="product-zoom" src="{{ asset($product->product_images) }}"
                                                data-zoom-image="{{ asset($product->product_images) }}" alt="product image">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure><!-- End .product-main-image -->
                                        @php
                                        $p_image =
                                        \App\model\admin\Product_image::where('product_id',$product->product_id)->get();
                                        @endphp
                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            <a class="product-gallery-item active" href="#"
                                                data-image="{{ asset($product->product_images) }}"
                                                data-zoom-image="{{ asset($product->product_images) }}">
                                                <img src="{{ asset($product->product_images) }}" alt="product side">
                                            </a>
                                            @foreach ($p_image as $image)
                                                <a class="product-gallery-item" href="#"
                                                    data-image="{{ asset($image->image) }}"
                                                    data-zoom-image="{{ asset($image->image) }}">
                                                    <img src="{{ asset($image->image) }}" alt="product side">
                                                </a>
                                            @endforeach
                                        </div><!-- End .product-image-gallery -->
                                    </div><!-- End .product-gallery -->
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <div class="product-details product-details-sidebar">
                                        <h1 class="product-title">{{ $product->product_name }}</h1>
                                        <!-- End .product-title -->

                                        @php
                                               $ratingCount = \App\Rating::where('product_id',$product->product_id)->count();
                                            @endphp
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: {{ $product->avgRating() }}%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <a class="ratings-text" href="#product-review-link" id="review-link">( {{ $ratingCount }} Reviews )</a>
                                            </div><!-- End .rating-container -->

                                        <div class="product-price" id="price">
                                            @if ($product->stocktype == 1)
                                                @php
                                                $maxprice =
                                                \App\model\ProductStock::where('product_id',$product->product_id)->max('price');
                                                $minprice =
                                                \App\model\ProductStock::where('product_id',$product->product_id)->min('price');

                                                @endphp
                                                @if ($maxprice == $minprice)
                                                    <span>NPR.{{ $maxprice }}</span>
                                                @else
                                                    <span>NPR.{{ $minprice }}</span> <span
                                                        class="p-4 text-warning">To</span> <span>NPR.{{ $maxprice }}</span>
                                                @endif
                                            @else
                                            @php
                                                $onsale=$product->onSale();
                                            @endphp

                                            @if ($product->promo == 0 && !$onsale)
                                                Rs. {{ $product->mark_price }}
                                            @else
                                                @if ($onsale)
                                                    @php
                                                    $sellproduct=$product->sale();
                                                    $sell=$sellproduct->onsale;
                                                    @endphp
                                                    <span class="new-price">Rs. {{ $product->salePrice() }} </span>
                                                @else
                                                    <span class="new-price">Rs. {{ $product->sell_price }} </span>
                                                @endif
                                                <span class="old-price">Was <span style="text-decoration: line-through;">Rs.
                                                        {{ $product->mark_price }}</span></span>
                                            @endif
                                            @endif

                                        </div><!-- End .product-price -->


                                        <div class="product-content">
                                            <p>{{ $product->product_short_description }}</p>
                                        </div><!-- End .product-content -->


                                        <form action="{{ route('public.cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <input type="hidden" name="type" value="{{ $product->stocktype }}">
                                            <input type="hidden" name="varient" id="product_varient">
                                            @if ($product->stocktype == 0)
                                                @if ($product->promo == 0 && !$onsale)
                                                    <input type="hidden" name="rate" value="{{ $product->mark_price }}">
                                                    @else
                                                        @if ($onsale)
                                                            <input type="hidden" name="rate" value="{{ $product->salePrice() }}">
                                                        @else
                                                            <input type="hidden" name="rate" value="{{ $product->$product->sell_price() }}">
                                                        @endif
                                                    @endif
                                                @else
                                                    <input type="hidden" name="rate" id="rateofvariant">
                                                @endif
                                            @foreach ($product->variants() as $variant)
                                                <div class="details-filter-row details-row-size">
                                                    <label for="size">{{ $variant->name }}</label>
                                                    <div class="select-custom">
                                                        <select data-role="variant" data-id="{{ $variant->id }}"
                                                            class="form-control" name="attribute_{{ $variant->id }}"
                                                            id="attribute_{{ $variant->id }}" required>
                                                            <option>Select a {{ $variant->name }}</option>
                                                            @foreach ($variant->options as $option)
                                                                <option value="{{ $option->id }}">{{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div><!-- End .select-custom -->

                                                </div><!-- End .details-filter-row -->

                                            @endforeach
                                            <div class="product-details-action" id="product-details-action">
                                                @if ($product->stocktype == 0)
                                                    @if ($product->quantity>0)

                                                    <div class="details-action-col">
                                                        <label for="qty">Qty:</label>
                                                        <div class="product-details-quantity">
                                                            <input max="{{ $product->quantity }}" min="1" type="number"
                                                                id="qty" name="qty" class="form-control" value="1" min="1"
                                                              step="1" data-decimals="0" required>
                                                        </div><!-- End .product-details-quantity -->

                                                        <button class="btn-product btn-cart text-white" style="color: white">
                                                            <span class="text-white">
                                                                add to
                                                                cart
                                                            </span>
                                                        </button>
                                                    </div><!-- End .details-action-col -->
                                                    @else
                                                        <span class="badge badge-danger">Out Of Stock</span>
                                                    @endif
                                                @else
                                                    <div id="product-variant-stock" class="mb-1">

                                                    </div>
                                                @endif
                                                <div class="details-action-wrapper">
                                                    <a href="{{ route('user.wishlist', $product->product_id) }}"
                                                        class="btn-product btn-wishlist p-1 pr-3 pl-3" title="Wishlist"><span>Add to
                                                            Wishlist</span></a>
                                                    <a href="#" class="btn-product btn-compare p-1 pr-3 pl-3" title="Compare"><span>Add to
                                                            Compare</span></a>
                                                </div><!-- End .details-action-wrapper -->
                                            </div><!-- End .product-details-action -->


                                            <div class="product-details-footer details-footer-col">
                                                <div class="product-cat">
                                                    <span>Category:</span>
                                                    <a href="#">{{ $product->category->cat_name }}</a>
                                                </div><!-- End .product-cat -->

                                                <div class="social-icons social-icons-sm">
                                                    <span class="social-label">Share:</span>
                                                    <a class="social-icon" href="https://www.facebook.com/sharer/sharer.php?u={{route('product.detail',['id'=>$product->product_id])}}" target="_blank">
                                                        <i class="icon-facebook-f"></i>
                                                    </a>
                                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                            class="icon-twitter"></i></a>
                                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                            class="icon-instagram"></i></a>
                                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                            class="icon-pinterest"></i></a>
                                                </div>
                                            </div><!-- End .product-details-footer -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .product-details-top -->


                    </div><!-- End .col-lg-9 -->

                    <aside class="col-lg-3">
                        <div class="sidebar sidebar-product">
                            <div class="widget widget-products">
                                <div class="extra-feature">
                                    @php
                                    $extraChargeCount =\App\ExtraCharge::where('product_id',$product->product_id)->where('enabled',1)->count();
                                    $extraCharge =\App\ExtraCharge::where('product_id',$product->product_id)->where('enabled',1)->get();
                                    @endphp
                                    @if ($extraChargeCount > 0)
                                        <h4 class="widget-title">Product Extra Feature</h4><!-- End .widget-title -->
                                        <div class=" mb-3">
                                            @foreach ($extraCharge as $charge)
                                                <div class="custom-control custom-checkbox checkbox-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="extracharge_{{ $charge->id }}" name="extracharge[]"
                                                        value="{{ $charge->id }}">
                                                    <label class="custom-control-label pr-4"
                                                        for="extracharge_{{ $charge->id }}"><strong>{{ $charge->name }}
                                                            <span class="text-danger"> (Rs.{{ $charge->amount }})
                                                            </span></strong></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                </form>
                                @php

                                $productOption = \App\ProductOption::where('product_id',$product->product_id)->first();
                                @endphp
                                @if ($productOption!=null)


                                <h4 class="widget-title">Product Options</h4><!-- End .widget-title -->
                                <div class="mb-3">
                                    <strong>Product Warrenty : </strong>
                                @if ($productOption->warrenty == 1)
                                    No Warranty
                                @elseif($productOption->warrenty == 2)
                                    Local Warranty
                                @else
                                    Manufacturer Warranty
                                @endif <br>
                                @if ($productOption->warrenty != 1)

                                    <strong>Warrenty Time period : </strong> {{ $productOption->warrentyperiod }}
                                    {{ $productOption->warrentytime }} <br>
                                @endif
                                <strong>Refund Policy : </strong>
                                @if ($productOption->isrefundable == 1) <span
                                    class="badge badge-primary">Yes</span> @else <span
                                        class="badge badge-danger">No</span> @endif
                            </div>
                            @else
                            <div class="mb-3">
                                <strong>Product Warranty : </strong> No Warranty
                                <br>
                                <strong>Refund Policy : </strong><span class="badge badge-danger">No</span>
                            @endif


                        </div><!-- End .widget widget-products -->

                        {{-- <div class="widget widget-banner-sidebar">
                            <div class="banner-sidebar-title">ad box 280 x 280</div><!-- End .ad-title -->

                            <div class="banner-sidebar banner-overlay">
                                <a href="#">
                                    <img src="{{ asset('themes/molla/assets/images/blog/sidebar/banner.jpg') }}"
                                        alt="banner">
                                </a>
                            </div><!-- End .banner-ad -->
                        </div><!-- End .widget --> --}}
                    </div><!-- End .sidebar sidebar-product -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->

            <div class="row">
                <div class="col-lg-9">
                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab"
                                    href="#product-desc-tab" role="tab" aria-controls="product-desc-tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#refund-policy"
                                    role="tab" aria-controls="product-info-tab" aria-selected="false">Refund Policy</a>
                            </li>
                            <!-- <li class="nav-item">
                                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                                    </li> -->

                                    @php
                                        $ratingCount = \App\Rating::where('product_id',$product->product_id)->count();
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $ratingCount }})</a>
                                    </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                                aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Product Information</h3>
                                    {!! $product->product_description !!}
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="refund-policy" role="tabpanel"
                                aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    @php
                                    $productOptionCount =
                                    \App\ProductOption::where('product_id',$product->product_id)->count();
                                    $productOption =
                                    \App\ProductOption::where('product_id',$product->product_id)->first();
                                    @endphp
                                    @if ($productOptionCount > 0)
                                        {!! $productOption->refundablepolicy !!}
                                    @else
                                        <p class="text-warning">Refund policy is not available on this product</p>
                                    @endif
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                                aria-labelledby="product-shipping-link">
                                <div class="product-desc-content">
                                    <h3>Delivery & returns</h3>
                                    <p>We deliver to over 100 countries around the world. For full details of the
                                        delivery options we offer, please view our <a href="#">Delivery
                                            information</a><br>
                                        We hope you’ll love every purchase, but if you ever need to return an item you
                                        can do so within a month of receipt. For full details of how to make a return,
                                        please view our <a href="#">Returns information</a></p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                <div class="reviews">
                                    <h3>Reviews ({{ $ratingCount }})</h3>
                                    @foreach(\App\Rating::latest()->where('product_id',$product->product_id)->get() as $rate)
                                    @php
                                        $userName = \App\model\VendorUser\VendorUser::where('user_id',$rate->user_id)->select('fname','lname')->first();
                                    @endphp
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">{{ $userName->fname }} {{ substr($userName->lname,0,1) }}.</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: {{ $rate->rating * 20}}%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                </div><!-- End .rating-container -->
                                                <span class="review-date">{{ $rate->created_at->diffForHumans() }}</span>
                                            </div><!-- End .col -->
                                            <div class="col">
                                                <h4>{{ $rate->title }}</h4>

                                                <div class="review-content">
                                                    <p>{{ $rate->rating_desc }}</p>
                                                </div><!-- End .review-content -->

                                                <div class="review-action">
                                                    <!-- <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a> -->
                                                </div><!-- End .review-action -->
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->
                                    @endforeach

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="reviews">
                                                <h3>Your Ratings</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div style="margin:2rem 0;">
                                                @include('themes.molla.layouts.message')
                                            </div>
                                            @if ($errors->any())
                                              <div class="mb-3">
                                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                      <strong>Error has been occurred !</strong>
                                                          <ul>
                                                              @foreach ($errors->all() as $error)
                                                                  <li>{{ $error }}</li>
                                                              @endforeach
                                                          </ul>
                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                  </div>
                                              </div>
                                            @endif
                                    @if(!empty(Auth::check()) && Auth::user()->role_id==1)
                                        <form action="{{ route('user.ratings') }}" method="POST">
                                            @csrf
                                            <input class="rating" name="rating">
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <div class="form-group mt-1">
                                                <input type="text" name="title" class="form-control" placeholder="Review Title" required>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="rating_desc" rows="5" class="form-control" placeholder="Review Description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>Add Review</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                        @endif
                                        </div>
                                    </div>
                                </div><!-- End .reviews -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                    "nav": false,
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2

                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1200": {
                                            "items":4,
                                            "nav": true,
                                            "dots": false
                                        }
                                    }
                                }'>
                       @foreach (\App\model\admin\Product::where('category_id',$product->category_id)->inRandomOrder()->take(8)->get() as $item)
                           @include('themes.molla.elements.product',['product'=>$item])
                       @endforeach


                    </div><!-- End .owl-carousel -->
                </div>
                <aside class="col-lg-3">

                    @php
                    $productOptionCount = \App\ProductOption::where('product_id',$product->product_id)->count();

                    @endphp

                    <h4 class="widget-title">Related Product</h4><!-- End .widget-title -->
                    <div class="products">
                        @foreach (\App\model\admin\Product::where('category_id', $product->category->cat_id)
        ->inRandomOrder()
        ->take(5)
        ->get()
    as $p)
                            <div class="product product-sm">
                                <figure class="product-media media-single">
                                    <a href="{{ route('product.detail', $p->product_id) }}">
                                        <img src="{{ asset($p->product_images) }}" alt="Product image"
                                            class="product-image">
                                    </a>
                                </figure>

                                <div class="product-body product-body-single">
                                    <h5 class="product-title"><a
                                            href="{{ route('product.detail', $p->product_id) }}">{{ $p->product_name }}</a>
                                    </h5><!-- End .product-title -->
                                    <div class="product-price product-price-single">
                                        <span class="new-price">NPR.{{ $p->mark_price }}</span>
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product product-sm -->
                        @endforeach
                    </div><!-- End .products -->

                </aside>
            </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->

</main>

@endsection
@section('js')
<script src="{{ asset('themes/molla/assets/js/jquery.elevateZoom.min.js') }}"></script>
<script>
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    var pid = {{$product->product_id}};

    $('[data-role="variant"]').change(function() {
        var elements = document.querySelectorAll('[data-role="variant"]');
        var attributes = [];
        console.log(elements);
        var data = {
            "product_id": pid
        };
        elements.forEach(element => {
            attributes.push(element.dataset.id);
            data['attribute_' + element.dataset.id] = $(element).val();
        });
        data['attributes'] = attributes;
        console.log(data);
        axios.post("{{ url('product/stock/get') }}", data)
            .then(function(response) {
                // handle success
                console.log(response);
                var innerdata = response.data;
                if (innerdata.sucess) {
                    html =
                        ' <div class="details-action-col"><label for="qty">Qty:</label><div class="product-details-quantity"><input max="' +
                        innerdata.data.qty +
                        '" min="1" type="number" id="qty" name="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required></div><button class="btn-product btn-cart"><span>add to cart</span></button></div>';
                    $('#product-variant-stock').html(html);

                    $('#price').text("NPR." + innerdata.data.price);
                    $('#product_varient').val(innerdata.data.code);
                    $('#rateofvariant').val(innerdata.data.price);
                } else {
                    if (innerdata.type == 1) {
                        $('#product-variant-stock').text(innerdata.data);
                    }
                }
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            })

    });

</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="vEByKOut"></script>
<script src="{{ asset('themes/molla/assets/js/simple-rating.js') }}"></script>
   <script type="text/javascript">
      $(document).ready(function(){
        $('.rating').rating();
      });
    </script>
@endsection
