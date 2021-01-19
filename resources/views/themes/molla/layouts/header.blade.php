
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
<div class="mobile-header" >
    <form action="/search" class="w-100">
        <input type="search" placeholder="Search Product" class="w-100" name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}">
    </form>
</div>
@endif
<script>
    var headercolor="{{env('mobile_footer_color','#343A40')}}";
    var headercolortop={{Route::is('public.home')?240:0}}
</script>

<div class="mobile-footer d-flex d-md-none" style="background:{{env('mobile_footer_color','#343A40')}} !important;">
    <div class="footer-item">
        <a href="{{ url('/') }}" >
            <div class="icon">
                <i class="icon-shopping-cart"></i>
            </div>
            <div class="text">
                Home
            </div>
        </a>
    </div>

    <div class="footer-item">
        <a href="{{ url('') }}" >
            <div class="icon">
                <i class="icon-shopping-cart"></i>
            </div>
            <div class="text">
                Category
            </div>
        </a>
    </div>
    <div class="footer-item">
      <a href="{{ url('/viewcart') }}">
        <div class="icon">
            <i class="icon-shopping-cart"></i>
        </div>
        <div class="text">
            Cart
        </div>
      </a>
    </div>
    <div class="footer-item">
        <a href="{{ route('user.account') }}">
            <div class="icon">
                <i class="icon-user"></i>
            </div>
            <div class="text">
                Account
            </div>
        </a>
    </div>
</div>
