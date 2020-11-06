<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>@yield('title','')</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="{{ asset('themes/userdashboard/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/userdashboard/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/userdashboard/plugins/charts-c3/plugin.css') }}" />

    <link rel="stylesheet" href="{{ asset('themes/userdashboard/plugins/morrisjs/morris.min.css') }}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('themes/userdashboard/plugins/dropify/css/dropify.min.css') }}">

    <link rel="stylesheet" href="{{ asset('themes/userdashboard/css/style.min.css') }}">
    @yield('css')
</head>

<body class="theme-blush">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('themes/userdashboard/images/loader.svg') }}" width="48" height="48" alt="Aero"></div>
            <p>Please wait...</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    @php
    $user = \App\model\VendorUser\VendorUser::where('user_id',Auth::user()->id)->first();
    @endphp


    @include('themes.molla.user.onesignal')
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="navbar-brand">
            <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
            <a href="#"><span class="m-l-10">User Account</span></a>
        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        @if($user->profile_img != 'profile.png')
                        <a class="image" href="{{ route('user.account.profile') }}"><img src="{{ asset($user->profile_img) }}" alt="User"></a>
                        @else
                        <a class="image" href="{{ route('user.account.profile') }}"><img src="{{ asset('images/user/user.png') }}" alt="User"></a>
                        @endif
                        <div class="detail">
                            <h4>{{ $user->fname}} {{ $user->lname}}</h4>
                            <small>Consumer</small>
                        </div>
                    </div>
                </li>
                <li class="active open"><a href="{{ route('user.account.profile') }}"><i class="zmdi zmdi-home"></i><span>User Dashboard</span></a></li>
                <li><a href="{{ route('user.order') }}" class="waves-effect waves-block"><i class="zmdi zmdi-shopping-cart"></i><span>Orders</span></a></li>
                <li><a href="{{ route('account.detail') }}" class="waves-effect waves-block"><i class="zmdi zmdi-lock"></i><span>Account Details</span></a></li>
                <li><a href="{{ route('user.wishlist.page') }}" class="waves-effect waves-block"><i class="zmdi zmdi-assignment"></i><span>Wishlist Items</span></a></li>
                <li><a href="{{ route('user.getLogout') }}" class="waves-effect waves-block"><i class="zmdi zmdi-power"></i><span>Sign Out</span></a></li>
            </ul>
        </div>
    </aside>



    <!-- Main Content -->
    @yield('content')


    <!-- Jquery Core Js -->
    <script src="{{ asset('themes/userdashboard/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="{{ asset('themes/userdashboard/bundles/vendorscripts.bundle.js') }}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ asset('themes/userdashboard/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('themes/userdashboard/bundles/sparkline.bundle.js') }}"></script> <!-- Sparkline Plugin Js -->
    <script src="{{ asset('themes/userdashboard/bundles/c3.bundle.js') }}"></script>


    <script src="{{ asset('themes/userdashboard/bundles/mainscripts.bundle.js') }}"></script>

    <script src="{{ asset('themes/userdashboard/js/pages/index.js') }}"></script>
    @yield('js')
</body>


</html>