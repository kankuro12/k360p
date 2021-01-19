
<header class="header header-14">
    <div class="header-top d-none d-lg-flex" style="background-color: {{ env('secondaryheader_bg', '#3d4273') }};color: {{ env('secondaryheader_color', '#ffffff') }};">
        <div class="container-fluid pt-1 pt-md-0 pb-1 pb-md-0">
            @php
                $clearinfo = \App\Clearfix::first();
            @endphp
            <div class="header-left">
                <span>
                    {{$clearinfo->title}} <a href="{{ url($clearinfo->link) }}"
                        class="text-warning ml-2"> {{ $clearinfo->link_title}} </a>
                </span>
            </div><!-- End .header-left -->

            <div class="header-right d-none d-md-flex">

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul class="menus">
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">NPR</a>
                                </div><!-- End .header-dropdown -->
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">English</a>
                                </div><!-- End .header-dropdown -->
                            </li>
                            @if (empty(Auth::check()))
                                <li class="login">
                                    <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                                </li>
                            @else
                                @if (Auth::user()->role_id == 1)
                                    <li>
                                        <div>
                                            <a href="{{ route('user.account') }}"><i class="icon-user"></i>My
                                                Account</a>
                                        </div><!-- End .header-dropdown -->
                                    </li>
                                @else
                                    <li>
                                        <div>
                                            <a href="{{ route('vendor.dashboard') }}"><i class="icon-user"></i>My
                                                Account</a>
                                        </div><!-- End .header-dropdown -->
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

@if(env('enable_mobile_header',1)!=1)

    <div class="header-top d-lg-none d-block "
        style="font-weight:500;background-color: {{ env('secondaryheader_bg', '3d4273') }};color: {{ env('secondaryheader_color', 'ffffff') }};">
        <div class="container d-flex justify-content-between" style="padding:1rem 2rem;">

            <span>
                <div >
                    <a href="{{route('vendor.getRegister')}}" class="side-link" >Become A Seller</a>
                </div>
            </span>
            <span>
                @if (empty(Auth::check()))
                    <div class="login">
                        <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                    </div>
                @else
                    @if (Auth::user()->role_id == 1)
                        <div>
                            <div>
                                <a href="{{ route('user.account') }}"><i class="icon-user"></i>My Account</a>
                            </div><!-- End .header-dropdown -->
                        </div>
                    @elseif(Auth::user()->role_id == 2)
                        <div>
                            <div>
                                <a href="{{ route('vendor.dashboard') }}"><i class="icon-user"></i>My Account</a>
                            </div><!-- End .header-dropdown -->
                        </div>
                    @elseif(Auth::user()->role_id == 3)
                        <div>
                            <div>
                                <a href="{{ route('delivery.dashboard') }}"><i class="icon-user"></i>My Account</a>
                            </div><!-- End .header-dropdown -->
                        </div>
                    @endif
                @endif

            </span>
        </div>
    </div>
@endif
    <div class="header-middle {{env('enable_mobile_header',1)==1?"d-none d-md-block":""}}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-lg-3 col-xl-3 col-xxl-2">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>
                    <a href="/" class="logo">
                        <img src="{{ asset('images/mart1.png') }}" alt="{{ env('APP_NAME', 'your') }} Logo" width="250"
                        >
                    </a>
                </div><!-- End .col-xl-3 col-xxl-2 -->

                <div class="col col-lg-9 col-xl-9 col-xxl-10 header-middle-right"   style="margin-top: auto;margin-bottom: auto;">
                    <div class="row">
                        <div class="col-lg-8 col-xxl-4-5col d-none d-lg-block">
                            <div
                                class="header-search header-search-extended header-search-visible header-search-no-radius">
                                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                                <form action="/search" method="get">
                                    <div class="header-search-wrapper search-wrapper-wide" >

                                        <div class="select-custom" >
                                            <select id="cat" name="cat">
                                                <option value="">All Categories</option>
                                                @foreach ($cats as $item)
                                                    <option value="{{ $item->cat_id }}">{{ $item->cat_name }}</option>
                                                    @if (count($item->subcat))
                                                        @foreach ($item->subcat as $item1)
                                                            <option value="{{ $item1->cat_id }}">- {{ $item1->cat_name }}
                                                            </option>
                                                            @if (count($item1->subcat))
                                                                @foreach ($item1->subcat as $i)
                                                                    <option value="{{ $i->cat_id }}">-- {{ $i->cat_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                            <p onclick="dropclick(this)"></p>
                                        </div><!-- End .select-custom -->
                                        <label for="q" class="sr-only">Search</label>
                                        <input type="search" class="form-control" name="q" id="q"
                                            placeholder="Search product ..." required>

                                        <button class="btn btn-primary btn-search" type="submit"><i
                                                class="icon-search"></i></button>
                                    </div><!-- End .header-search-wrapper -->
                                </form>
                            </div><!-- End .header-search -->
                        </div><!-- End .col-xxl-4-5col -->

                        <div class="col-lg-4 col-xxl-5col d-flex justify-content-end align-items-center">
                            <div class="header-dropdown-link">
                                {{-- <div class="dropdown compare-dropdown">
                                    <a href="#" class="dropdown-toggle " role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-display="static"
                                        title="Compare Products" aria-label="Compare Products">
                                        <i class="icon-random"></i>
                                        <span class="compare-txt">Compare</span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right msp">
                                        <ul class="compare-products">
                                            <li class="compare-product">
                                                <a href="#" class="btn-remove" title="Remove Product"><i
                                                        class="icon-close"></i></a>
                                                <h4 class="compare-product-title"><a href="product.html">Blue Night
                                                        Dress</a></h4>
                                            </li>
                                            <li class="compare-product">
                                                <a href="#" class="btn-remove" title="Remove Product"><i
                                                        class="icon-close"></i></a>
                                                <h4 class="compare-product-title"><a href="product.html">White Long
                                                        Skirt</a></h4>
                                            </li>
                                        </ul>

                                        <div class="compare-actions">
                                            <a href="#" class="action-link">Clear All</a>
                                            <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div>
                                    </div><!-- End .dropdown-menu -->
                                </div><!-- End .compare-dropdown --> --}}
                                @php
                                if(!empty(Auth::check())){
                                $wishlistCount = \App\Wishlist::where('user_id',Auth::user()->id)->count();
                                }
                                @endphp
                                <a href="{{ route('user.wishlist.page') }}" class="wishlist-link btn-icon">
                                    <i class="icon-heart-o"></i>
                                    @if (!empty(Auth::check()))
                                        <span class="wishlist-count"> {{ $wishlistCount }} </span>
                                    @else
                                        <span class="wishlist-count"> 0 </span>
                                    @endif
                                    <span class=" btn-icon-text">Wishlist</span>
                                </a>

                                @php
                                $simpletotal = 0;
                                $varianttotal = 0;
                                $session_id = Session::get('session_id');
                                $cartCount = \App\model\Cart::where('session_id',$session_id)->count();
                                $cartItem = \App\model\Cart::where('session_id',$session_id)->get();
                                @endphp

                                <div class="dropdown cart-dropdown">
                                    <a href="#" class="dropdown-toggle btn-icon" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-display="static">
                                        <i class="icon-shopping-cart"></i>
                                        <span class="cart-count">{{ $cartCount }}</span>
                                        <span class="btn-icon-text">Cart</span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-cart-products">
                                            @foreach ($cartItem as $item)
                                                @php
                                                $price =
                                                \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                                if($item->product->stocktype == 1){
                                                $varianttotal = $varianttotal + $item->qty * $price->price;
                                                }else{
                                                $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                                }
                                                @endphp
                                                <div class="product">
                                                    <div class="product-cart-details">
                                                        <h4 class="product-title">
                                                            <a
                                                                href="{{ route('product.detail', $item->product_id) }}">{{ $item->product->product_name }}</a>
                                                        </h4>

                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty">{{ $item->qty }}</span> x
                                                            @if ($item->product->stocktype == 0)
                                                                <td class="total-col">
                                                                    NPR.{{ $item->product->sell_price }} </td>
                                                            @else
                                                                <td class="total-col">NPR.{{ $price->price }} </td>
                                                            @endif
                                                        </span>
                                                    </div><!-- End .product-cart-details -->

                                                    <figure class="product-image-container">
                                                        <a href="product.html" class="product-image">
                                                            <img src="{{ asset($item->product->product_images) }}"
                                                                alt="product">
                                                        </a>
                                                    </figure>
                                                    <a href="{{ url('remove/cart/item/' . $item->id) }}"
                                                        class="btn-remove" title="Remove Product"><i
                                                            class="icon-close"></i></a>
                                                </div><!-- End .product -->
                                            @endforeach
                                        </div><!-- End .cart-product -->

                                        <div class="dropdown-cart-total">
                                            <span>Total</span>

                                            <span class="cart-total-price">NPR.{{ $varianttotal + $simpletotal }}</span>
                                        </div><!-- End .dropdown-cart-total -->

                                        <div class="dropdown-cart-action">
                                            <a href="{{ route('public.viewcart') }}" class="btn btn-primary btn-search">View
                                                Cart</a>
                                            <a href="{{ url('user/checkout') }}"
                                                class="btn btn-outline-primary-2 btn-search-outline"><span>Checkout</span><i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .dropdown-cart-total -->
                                    </div><!-- End .dropdown-menu -->
                                </div><!-- End .cart-dropdown -->
                            </div>
                        </div><!-- End .col-xxl-5col -->
                    </div><!-- End .row -->
                </div><!-- End .col-xl-9 col-xxl-10 -->
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header" style="color:{{env('primaryheader_color','#ffffff')}} !important;background:{{env('primaryheader_bg','#232642')}} !important">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-lg-3 col-xl-3 col-xxl-2 header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-display="static" title="Browse Categories"
                            style="color:{{env('megamenu_color','#333')}} !important;background:{{env('megamenu_bg','#fcb941')}} !important">
                            {{ env('browse', 'Browse Categories') }}
                        </a>

                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                @if (empty(Auth::check()))
                                    <h6 class="mt-1 ml-4"><i class="icon-user"></i> Hello ! Guest</h6>
                                @else
                                    <h6 class="mt-1 ml-4"> <i class="icon-user"></i>
                                        @if (Auth::user()->role_id == 1)
                                            @php
                                            $user =
                                            \App\model\vendoruser\VendorUser::where('user_id',Auth::user()->id)->first();
                                            @endphp
                                            Hello ! {{ $user->fname }} {{ $user->lname }}
                                        @elseif(Auth::user()->role_id == 2)
                                            Hello ! {{ Auth::user()->vendor->name }}
                                        @elseif(Auth::user()->role_id == 3)
                                            Hello ! {{ Auth::user()->point->name }}
                                        @endif
                                    </h6>
                                @endif
                                @foreach (\App\model\admin\Menu::orderBy('order')->get() as $menu)
                                    @if ($menu->type == 1)
                                        @include('themes.molla.elements.menu.category',['menu'=>$menu])
                                    @elseif($menu->type==2)
                                        @include('themes.molla.elements.menu.collection',['menu'=>$menu])
                                    @elseif($menu->type==0)
                                        @include('themes.molla.elements.menu.brand',['menu'=>$menu])
                                    @elseif($menu->type==3)
                                        @include('themes.molla.elements.menu.sales',['menu'=>$menu])
                                    @endif
                                @endforeach
                            </nav><!-- End .side-nav -->

                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->


                </div><!-- End .col-xl-3 col-xxl-2 -->

                <div class="col col-lg-6 col-xl-6 col-xxl-8 header-left">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container {{ (Route::is('public.home') ? ' active' : '')}}">
                                <a href="{{ url('/') }}" class="sf-with">Home</a>
                            </li>
                            <li class="megamenu-container {{ (Route::is('shops') ? ' active' : '')}}">
                                <a href="{{ route('shops') }}" class="sf-with">Shop</a>
                            </li>
                            <li>
                                <a href="{{ url('collection-product') }}" class="sf-with">Our Collection</a>
                            </li>

                            <li>
                                <a href="{{ url('sale-product') }}" class="sf-with">Buy Cheaper</a>
                            </li>

                            <li>
                                <a href="{{route('public.about')}}" class="sf-with">About Us</a>
                            </li>

                            {{-- <li>
                                <a href="{{route('public.contact')}}" class="sf-with">Contact Us</a>
                            </li> --}}

                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->
                </div><!-- End .col-xl-9 col-xxl-10 -->
                <div class="col col-lg-3 col-xl-3 col-xxl-2 header-center">
                    <a href="{{ url('vendor/login') }}" class="side-link">Become a Seller</a>
                </div>

            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
@if(env('enable_mobile_header',1)==1)
@if (!Route::is('product.detail') || !Route::is('public.cart'))
<div class="mobile-header d-block d-md-none" >
    <form action="/search" class="w-100">
        <input type="search" placeholder="Search Product" class="w-100" name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}">
    </form>
</div>
@endif
@endif
<script>
    var headercolor="{{env('mobile_footer_color','#343A40')}}";
    var headercolortop={{Route::is('public.home')?240:0}}
</script>

<div class="mobile-footer d-flex d-md-none" style="background:{{env('mobile_footer_color','#fefefe')}} !important;">
    <div class="footer-item">
        <a href="{{ url('/') }}" >
            <div class="icon">
                <img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAACYElEQVRIid2Uv09TURTHP+fd8l6xPwYSo4FIKBoXkw4WU0sRnppgQGochMnB0cS4aRzBf8G/wQ3i0hpw0AAxIBEH4z9gwsBmlFZKr+27DvTVUtpSZNJvcpZzz/1+zjvv5MK/omTy5plU6lZPY146N5iIVqziSwDldd/f2Fjc8c8SKfeuCK+AsjFe4tP66hf/zOrEPB4fD1XUbhYhg5CpqOJSMjkRrXUpcrHabJeIGqy/eyQgnU5H7Ih+AzIKrFQj1QhppbaAeHw8VDJdWQxp4H3RZsqUIpOCedcpJNDO3A7pHDBWNZ/o1jwRJx/0StGM5exkDXKjoopLAm/NcQCXXDdsa70IjAArumDf7g7rp8CsAcTJ75UKzh07rF8DYwaTaLUvhwDx+HjILukswki18ynfvK5s1gnroFeKTPpf0moSBwCJROaU2Pkcgls/lgZzAAw8s5w89eNqBlAHzJ18DuH6UeZ1GrECOuCVog+tQCkFEkM4F+vvm9/a2tI1QM2cY5m3goxVRI36EHVC89YQ1LVYf9+C6hvofYEwzf62TAZVpfGHdgyRgC7rgvNY2ZU0MOqhTqve/lgQwzf9035gH94WX3sCnwW2/QB6OLyFrrIrv3TBfqTs8lmMtVpb3qFhd65N59Oba8sL9YmhYfceMN+i/vnm2vIcVJ+Kyyn3Qhtz8GS7o9wfzVY99wGWJapN8V/J9+zouT4R6P8AiDY/2lYJ5zvK1UmVre/7ZVVdGXbXDVxtXm484GtDcgCk6QQEPnxcW05B/YgC3oyBHJjdJlcskMGGaGJudg3kCHgzfuY3kwvqMPBDPbgAAAAASUVORK5CYII=">
            </div>
            <div class="text">
                Home
            </div>
        </a>
    </div>


    <div class="footer-item">
        <a href="{{ url('/shops') }}">
          <div class="icon">
            <img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAz0lEQVRIie2Uuw3CMBRFj00UqAKjMEJSUAYGALEBTMMi0FKQEWATSIUiK48iQtiAzCcIic/pbF/d+55/8OcGyh5047jTKJgpJAUVXag1CQAlq0sryUEtTMhknWXb42xgSypzhme599YaAaOgUAKMTzU57Uj6hPMZ0rdH2l28si2P0/YEvJ5/wE2ca6pKej7xXpsNQKsMvDqb93YgmqVP3CRI7tFhvdTPP+SvC5D8BZ47T4Ba1Pd3PZxrakIm1X9eDh7/WSUHPTehTOsX+VMcACCdK9xHAFIRAAAAAElFTkSuQmCC">
          </div>
          <div class="text">
              Shop
          </div>
        </a>
      </div>
      <div class="footer-item">
        <a href="{{ url('') }}" >
            <div class="icon">
                <img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAC10lEQVRIibWV22tUVxSHv3XOmZlIUxUi1turNSpJR8eJjAR7Ilrbgpe/QApFRBDxtXhhJD6LWhvxEoS+lUJBfRBvyQiSZKInxgkxM46PRo1mBFvRzCRnrz7ojIO5TRq7ns5e+6zf91ucvc4Wpomw686387oFkRWifAWgwpBAWvPODc+7+XqqeplsY21jU0SMxgW2AoGJ39ICKtdUrbjX1dZTESAWi80ZlarfQH+aysAnIIPKxeoQ+xKJxMikgGjUXaQBLgPRyoTHgbpt39meTN4aGgdwXbfqTUFvgzT8N/GSoGfyX270vCtvAazixpuCtMxWHEAhYoX+OVkGhOgGN6yoB2JNXjozjrEk2nOn3XMADDTLB3HHcQjX15F79Yong4OE6+sQa3qu8Q29qT7GxsYAxDLmCLBDIpHN8yQ0+gIkCBCur+P8mVM8yj7mxK8ttJw6XrHt3Xv305vqKy5Hx4IsdKwqf6vqe3GA4VyO/odpBjIZXg7neDiQrriD4VyuPBVwCmyWyAb3kEBzxTZnEiIHHdDF5eNQu2I5v7eeJdXXz8nTZ2g9exqR6edNVdn18x7SmezHpNHFlojo/2EeABF1UJ6V59KZLA2Nm0rr8ueZ65tnjohkVT82sWzpEo7FDzOQyfDHn39x9PAvFX/kQ/Fmngw+LeVUJeuYEfuahEYLxWO6oKaG1atqCQQc2tpvs2plbcWOF9TUlAPytj/nugCsi7mXEbbB7Abt/oMUvu8XU5fudSR2CkBDY9M3xpiez/erUKPGjnpdbT0WQPed9geoXPw84gBcKF5AJcfVIfahJGerLOAFtHCguC4BEonEiG3sHaDdsxDvyhP8sbOz8904AEAyeWuoOijforSCmsql1YCe+yJIU6rj+otPoBPHutjGNYjEge+LR3gC4QLIVYH43Y5E7yRdTR3r1/8w17fffYfI1yiLPlQ9R8nYftWNZPLq31PV/ws/gCDmruY5dwAAAABJRU5ErkJggg==">            </div>
            <div class="text">
                Category
            </div>
        </a>
    </div>
    <div class="footer-item">
      <a href="{{ url('/viewcart') }}">
        <div class="icon">
            <img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABrUlEQVRIidWUP0ubURTGf+e+CdgOugilky0URHAKobYZYsCtHToWutSh+AX8BE5+BqFzF+miNkkNNBqrqbYiFIQOglGMYsRCCiFo4j0OEon5y/vm7eAz3cNzeH733sO98J8lgIQjsbeC9Cucl4uDi7u785d+AQLPo9EntsonRQXgwUAhDrz2C2C2Mpl958oOWyNhgY8gr0IvoiN+ARyAfP7g78lh7uTx0NOCKB8Mkjs+ym34ATD1xfb39E/gVH28okBDbUVJqvAuHBmf85wqUglaM5vNfss3AsBIHNX3IFOeAQoV0TTw2TR6ptqXBCqew28I9sqpZqBhBgCbm4l/KOu9xAuys7O2dtYScNPAl14AVmW5tm4JsLDUCwBjUx0B29mVP8Cep3ClVOx/ePuGWgIABI17Aggre4nERVeAxfE0B1FS9XVbABfFNMq+q3SlVDXB+TvATv2hl7FnjtEZVIa7ZivHRnR2a2M162pTvarjCQDCkdiowKSKfv21vppy67efQU3KgsI0ytLY2MQjt353gKjWlmXHUbd+82/anPBGYBIryd8/lgvu/fuua52op0NVvj8MAAAAAElFTkSuQmCC">        </div>
        <div class="text">
            Cart
        </div>
      </a>
    </div>
    <div class="footer-item">
        <a href="{{ route('user.account') }}">
            <div class="icon">
                <img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAACDUlEQVRIia2UwWsTQRSHv7drmth6iNAKYi8BRbRQqKmUWoQtFaRKT/4BHoXePJWe+0cIHjx5KbkIVdSDTWywi62rJ1FRD6JFUYyQ1JQkm3keTNS26+529Z2Wmff7vplZZoSIGjs7dbLt+wuIjCs0RLm9lWb+eam0GZUFkLDJU2NTw5bVXkXo2x7Sz4psiMrVdbf4MIxhhU7a/rWdcABFDgEjKlrI52d6EwlGJyaPg5wJCwMDdk/1fCKBqI5HwAEwlnUikUCVbByBqO5PJED4FEdghHeJBBYaGvzdJ9VEAqMyHEegqseSCcR6HUcA8jKR4Onqcgm4E0Ev5o7030okAIzl25eB1t8aVJktFArtpALW1h58BbkZTGfJc0uhxxMpAGjb/hwBuzBq5qKysQQ9Tcnu7lNj2baJIwh8TYcc50Bvi4uKXhCVGYWDAW0tQcuo3CVlFtdXVt5HCo5OT6ez1fosKvPAQJwVdqoBcr1t+wvPyuUvgYK84/RbTe4p5PcA3lkfEDn35FHxVXfg19lKgxv/CAcYVNVF/li4ADiOk9ls6neQyJ8ep1JqDbru8gZ0dlCr7Uv/LzhAU8h0vzvQb3XQ0FdxD/WGRt/HbQLP81pi5BLwIjFWeSzIla0eRjxvqd4d3nUPTk9MDhl0VJQcojlUDiOI6M+7oEoNtCIiFaO8FUu9lMl4rnu/EuT9AYJ7uEwYS1HzAAAAAElFTkSuQmCC">
            </div>
            <div class="text">
                Account
            </div>
        </a>
    </div>
</div>
