<header class="header header-14">
    <div class="header-top" style="background: #3d4273; color:white;">
        <div class="container">
            <div class="header-left">
               
            </div><!-- End .header-left -->

            <div class="header-right">

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul class="menus">
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">NPR</a>
                                    <div class="header-menu">
                                        
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropdown -->
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">Engligh</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropdown -->
                            </li>
                            @if (empty(Auth::check()))
                            <li class="login">
                                <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                            </li>
                            @else
                            @if(Auth::user()->role_id == 1)
                            <li>
                                <div class="header-dropdown">
                                    <a href="{{ route('user.account') }}"><i class="icon-user"></i>Account</a>
                                    <div class="header-menu">
                                    </div><!-- End .header-menu -->
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

    <div class="header-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-lg-3 col-xl-3 col-xxl-2">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>
                    <a href="index.html" class="logo">
                        <img src="assets/images/demos/demo-14/logo.png" alt="Molla Logo" width="105" height="25">
                    </a>
                </div><!-- End .col-xl-3 col-xxl-2 -->

                <div class="col col-lg-9 col-xl-9 col-xxl-10 header-middle-right">
                    <div class="row">
                        <div class="col-lg-8 col-xxl-4-5col d-none d-lg-block">
                            <div class="header-search header-search-extended header-search-visible header-search-no-radius">
                                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                                <form action="#" method="get">
                                    <div class="header-search-wrapper search-wrapper-wide">

                                        <div class="select-custom">
                                            <select id="cat" name="cat">
                                                <option value="">All Categories</option>
                                                @foreach ($cats as $item)
                                                <option value="{{$item->id}}">{{ $item->cat_name }}</option>
                                                @if (count($item->subcat))
                                                @foreach ($item->subcat as $item1)
                                                <option value="{{ $item1->id }}">- {{ $item1->cat_name }}</option>
                                                @if (count($item1->subcat))
                                                @foreach ($item1->subcat as $i)
                                                <option value="{{ $i->id }}">-- {{ $i->cat_name }}</option>
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </select>
                                        </div><!-- End .select-custom -->
                                        <label for="q" class="sr-only">Search</label>
                                        <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>

                                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    </div><!-- End .header-search-wrapper -->
                                </form>
                            </div><!-- End .header-search -->
                        </div><!-- End .col-xxl-4-5col -->

                        <div class="col-lg-4 col-xxl-5col d-flex justify-content-end align-items-center">
                            <div class="header-dropdown-link">
                                <div class="dropdown compare-dropdown">
                                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                                        <i class="icon-random"></i>
                                        <span class="compare-txt">Compare</span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="compare-products">
                                            <li class="compare-product">
                                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                                <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>
                                            </li>
                                            <li class="compare-product">
                                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                                <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>
                                            </li>
                                        </ul>

                                        <div class="compare-actions">
                                            <a href="#" class="action-link">Clear All</a>
                                            <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                                        </div>
                                    </div><!-- End .dropdown-menu -->
                                </div><!-- End .compare-dropdown -->

                                <a href="wishlist.html" class="wishlist-link">
                                    <i class="icon-heart-o"></i>
                                    <span class="wishlist-count">3</span>
                                    <span class="wishlist-txt">Wishlist</span>
                                </a>

                                @php
                                $simpletotal = 0;
                                $varianttotal = 0;
                                $session_id = Session::get('session_id');
                                $cartCount = \App\model\Cart::where('session_id',$session_id)->count();
                                $cartItem = \App\model\Cart::where('session_id',$session_id)->get();
                                @endphp

                                <div class="dropdown cart-dropdown">
                                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                        <i class="icon-shopping-cart"></i>
                                        <span class="cart-count">{{$cartCount}}</span>
                                        <span class="cart-txt">Cart</span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-cart-products">
                                            @foreach($cartItem as $item)
                                            @php
                                            $price = \App\model\ProductStock::where('product_id',$item->product_id)->where('code',$item->variant_code)->select('price')->first();
                                            if($item->product->stocktype == 1){
                                            $varianttotal = $varianttotal + $item->qty * $price->price;
                                            }else{
                                            $simpletotal = $simpletotal + $item->product->sell_price * $item->qty;
                                            }
                                            @endphp
                                            <div class="product">
                                                <div class="product-cart-details">
                                                    <h4 class="product-title">
                                                        <a href="{{ route('product.detail',$item->product_id) }}">{{ $item->product->product_name }}</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span class="cart-product-qty">{{ $item->qty }}</span> x
                                                        @if($item->product->stocktype == 0)
                                                        <td class="total-col">NPR.{{ $item->product->sell_price }} </td>
                                                        @else
                                                        <td class="total-col">NPR.{{ $price->price }} </td>
                                                        @endif
                                                    </span>
                                                </div><!-- End .product-cart-details -->

                                                <figure class="product-image-container">
                                                    <a href="product.html" class="product-image">
                                                        <img src="{{ asset($item->product->product_images) }}" alt="product">
                                                    </a>
                                                </figure>
                                                <a href="{{ url('remove/cart/item/'.$item->id) }}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                            </div><!-- End .product -->
                                            @endforeach
                                        </div><!-- End .cart-product -->

                                        <div class="dropdown-cart-total">
                                            <span>Total</span>

                                            <span class="cart-total-price">NPR.{{ $varianttotal + $simpletotal }}</span>
                                        </div><!-- End .dropdown-cart-total -->

                                        <div class="dropdown-cart-action">
                                            <a href="{{ route('public.viewcart') }}" class="btn btn-primary">View Cart</a>
                                            <a href="{{ url('user/checkout')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
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

    <div class="header-bottom sticky-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto col-lg-3 col-xl-3 col-xxl-2 header-left">
                    <div class="dropdown category-dropdown show is-on" data-visible="true">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            Browse Categories
                        </a>

                        <div class="dropdown-menu show">
                            <nav class="side-nav">
                                @if (empty(Auth::check()))
                                  <h6 class="mt-1 ml-4"><i class="icon-user"></i> Hello ! Guest</h6>
                                @else
                                    @php
                                        $user = \App\model\vendoruser\VendorUser::where('user_id',Auth::user()->id)->first();
                                    @endphp
                                    <h6 class="mt-1 ml-4"> <i class="icon-user"></i> Hello ! {{ $user->fname }} {{ $user->lname }} </h6>
                                @endif
                                @foreach ($cats as $attr)
                                <ul class="menu-vertical sf-arrows">
                                    <li class="megamenu-container">
                                        @if (count($attr->subcat) > 0)
                                        <a class="sf-with-ul" href="{{ url('shops-by-category/'.$attr->id) }}"><i class="icon-blender"></i> {{ $attr->cat_name }}</a>
                                        <div class="megamenu">
                                            <div class="row no-gutters">
                                                <div class="col-md-8">
                                                    <div class="menu-col">
                                                        <div class="row">
                                                            @if (count($attr->subcat))
                                                            @foreach ($attr->subcat as $item)
                                                            <div class="col-md-6">
                                                                <div class="menu-title"><a href="{{ url('shops-by-category/'.$item->id) }}"> {{ $item->cat_name }} </a></div><!-- End .menu-title -->
                                                                @if (count($item->subcat))
                                                                @foreach ($item->subcat as $item1)
                                                                <ul>
                                                                    <li><a href="{{ url('shops-by-category/'.$item1->id) }}"><strong>{{ $item1->cat_name }}</strong></a></li>
                                                                </ul>
                                                                @endforeach
                                                                @endif
                                                            </div><!-- End .col-md-6 -->
                                                            @endforeach
                                                            @endif
                                                        </div><!-- End .row -->
                                                    </div><!-- End .menu-col -->
                                                </div><!-- End .col-md-8 -->

                                                <div class="col-md-4">
                                                    <div class="banner banner-overlay">
                                                        <a href="category.html" class="banner banner-menu">
                                                            <img src="{{asset('themes/molla/assets/images/demos/demo-13/menu/banner-2.jpg') }}" alt="Banner">
                                                        </a>
                                                    </div><!-- End .banner banner-overlay -->
                                                </div><!-- End .col-md-4 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .megamenu -->
                                        @endif
                                        @if (count($attr->subcat) == null)
                                        <a href="{{ url('shops-by-category/'.$attr->id) }}"><i class="icon-blender"></i> {{ $attr->cat_name }}</a>
                                        @endif
                                    </li>
                                </ul>
                                @endforeach
                            </nav><!-- End .side-nav -->

                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->
                </div><!-- End .col-xl-3 col-xxl-2 -->

                <div class="col col-lg-6 col-xl-6 col-xxl-8 header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container active">
                                <a href="{{ url('/') }}" class="sf-with">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('shops')}}" class="sf-with">Shop</a>
                            </li>

                            <li>
                                <a href="#" class="sf-with">About Us</a>
                            </li>
                            <li>
                                <a href="#" class="sf-with">Contact Us</a>
                            </li>
                            <li>
                                <a href="blog.html" class="sf-with">Our Blog</a>
                            </li>

                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->
                </div><!-- End .col-xl-9 col-xxl-10 -->

                <div class="col col-lg-3 col-xl-3 col-xxl-2 header-right">
                   
                </div>
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->