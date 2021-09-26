<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{ asset('images/backend_images/sidebar-1.jpg') }}">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
<div class="logo">

<a href="#" class="simple-text logo-normal">

    <span class="sidebar-normal " style="
    padding-left: 2rem;
">  Multi Ecom  </span>
    @if(Auth::user()->vendor->verified==1)
    <span style="color:#0bb51c;">

        <span class="material-icons">
            verified_user
        </span>
    </span>
@endif

</a>
</div>
<div class="sidebar-wrapper">
<div class="user">
    <div class="photo">
        <img id="userphoto"  />
    </div>
    <div class="info">
        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
            <span id="vendorname">


            </span>
            <b class="caret"></b>
        </a>
        <div class="clearfix"></div>
        <div class="collapse" id="collapseExample">
            <ul class="nav">

                <li>
                    <a href="{{ url('vendor/edit-profile/'.Auth::user()->id) }}">
                        <span class="sidebar-mini"> EP </span>
                        <span class="sidebar-normal"> Edit Profile </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vendor.setting') }}">
                        <span class="sidebar-mini"> S </span>
                        <span class="sidebar-normal"> Settings </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vendor.shipping') }}">
                        <span class="sidebar-mini"> Ss </span>
                        <span class="sidebar-normal"> Update Shipping Detail </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vendor.verification') }}">
                        <span class="sidebar-mini"> Ss </span>
                        <span class="sidebar-normal"> Update Verification Detail </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vendor.verification') }}">
                        <span class="sidebar-mini"> Ss </span>
                        <span class="sidebar-normal"> Update Bank Detail </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vendor.accounts') }}">
                        <span class="sidebar-mini"> AC </span>
                        <span class="sidebar-normal"> My Finance </span>
                    </a>
                </li>


                <li >
                    <a href="/vendor/messages">
                        <span class="sidebar-mini"> Ms </span>
                        <span class="sidebar-normal"> Messages </span>
                    </a>
                </li>
                <li >
                    <a href="{{route('vendor.getLogout')}}">
                        <span class="sidebar-mini"> LG </span>
                        <span class="sidebar-normal"> Log Out </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<ul class="nav">
    <li >
        <a href="/vendor/dashboard">
            <i class="material-icons">dashboard</i>
            <p> Dashboard </p>
        </a>
    </li>
    @if(Auth::user()->vendor->verified==1)
    <li>
        <a data-toggle="collapse" href="#componentsExamples">
            <i class="material-icons">business_center</i>
            <p> Products
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="componentsExamples">
            <ul class="nav">
                <li class="{{ (Request::is('vendor/add-product') ? ' active' : '') }}">
                    <a href="{{ route('vendor.add-product') }}">
                        <span class="sidebar-mini"> AP </span>
                        <span class="sidebar-normal"> Add Product </span>
                    </a>
                </li>
                <li class="{{ (Request::is('vendor/manage-product') ? ' active' : '') }}">
                    <a href="{{ route('vendor.manage-product') }}">
                        <span class="sidebar-mini"> MP </span>
                        <span class="sidebar-normal"> Manage Products </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li >
        <a data-toggle="collapse" href="#orders" >
            <i class="material-icons">shopping_cart
            </i>
            <p> Orders
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="orders">
            <ul class="nav">
                @for ($i = 0; $i < 7; $i++)
                    <li class="{{ (Request::is('vendor/orders/'.$i) ? ' active' : '') }}">
                        <a href="{{route('vendor.orders',['status'=>$i])}}">
                            <i class="material-icons">{{\App\Setting\OrderManager::stageicons[$i]}}</i>
                            <p> {{\App\Setting\OrderManager::stages[$i]}} orders </p>
                        </a>
                    </li>
                @endfor
            </ul>
        </div>
    </li>
    <li>
        <a data-toggle="collapse" href="#promotion">
            <i class="material-icons">local_offer</i>
            <p> Promotion
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="promotion">
            <ul class="nav">
                <li class="{{ (Request::is('vendor/add-coupon') ? ' active' : '') }}">
                    <a href="{{ route('vendor.add-coupon') }}">
                        <span class="sidebar-mini"> AC </span>
                        <span class="sidebar-normal"> Add Coupon </span>
                    </a>
                </li>
                <li class="{{ (Request::is('vendor/manage-coupon') ? ' active' : '') }}">
                    <a href="{{ route('vendor.manage-coupon') }}">
                        <span class="sidebar-mini"> MC </span>
                        <span class="sidebar-normal"> Manage Coupons </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <a data-toggle="collapse" href="#sales">
            <i class="material-icons">shopping_basket</i>
            <p> Sales
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="sales">
            <ul class="nav">
                <li class="{{ (Request::is('vendor/sale-products') ? ' active' : '') }}">
                    <a href="{{ route('vendor.sale-products') }}">
                        <span class="sidebar-mini"> SP </span>
                        <span class="sidebar-normal"> Sale Products </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <a data-toggle="collapse" href="#moa">
            <i class="material-icons">shopping_cart
            </i>
            <p> Make a Order
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="moa">
            <ul class="nav">
                <li class="{{ (Request::is('vendor/product/order') ? ' active' : '') }}">
                    <a href="{{ route('vendor.product.order.index') }}">
                        <span class="sidebar-mini"> MO </span>
                        <span class="sidebar-normal"> Make a Order </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif
</ul>
</div>
</div>
