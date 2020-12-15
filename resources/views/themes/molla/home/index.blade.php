@extends('themes.molla.layouts.app')
@section('title', 'Home')
@section('css')
<link rel="stylesheet" href="themes/molla/assets/css/skins/skin-demo-14.css">
<link rel="stylesheet" href="themes/molla/assets/css/demos/demo-14.css">
@endsection
@section('contant')

<div style="height:1px;"></div>
{{-- <div class="container-fluid"> --}}

<div class="intro-slider-container slider-container-ratio mb-2">
    <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true
                        }'>
        @include('themes.molla.home.slider')

    </div><!-- End .intro-slider owl-carousel owl-simple -->

    <span class="slider-loader"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->
<div class="row">
    <div class="col-xl-9 col-xxl-10">
        <div class="row">
            <div class="col-lg-12 col-xxl-4-5col">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-2.jpg') }}" alt="Banner img desc">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle text-white d-none d-sm-block"><a href="#">Hottest
                                        Deals</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title text-white"><a href="#">Detox And Beautify <br>For Spring
                                        <br><span>Up To 20% Off</span></a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-3.png') }}" alt="Banner img desc">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle text-white d-none d-sm-block"><a href="#">Deal of the
                                        Day</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title text-white"><a href="#">Headphones <br><span>Up To 30%
                                            Off</span></a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .col-lg-3 col-xxl-4-5col -->

            <div class="col-12 col-xxl-5col d-none d-xxl-block">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-4.jpg') }}" alt="Banner img desc">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white"><a href="#">Clearance</a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#">Seating and Tables Clearance</a></h3>
                        <!-- End .banner-title -->
                        <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner banner-overlay -->
            </div><!-- End .col-lg-3 col-xxl-2 -->
        </div><!-- End .row -->

        <div class="mb-3"></div><!-- End .mb-3 -->

        @include('themes.molla.home.brand')

        <div class="mb-5"></div><!-- End .mb-5 -->

        @include('themes.molla.home.tranding')

        <div class="mb-5"></div><!-- End .mb-5 -->

        @include('themes.molla.home.with_banner_1')

        <div class="mb-3"></div><!-- End .mb-3 -->

        @include('themes.molla.home.with_banner_2')


        <div class="mb-3"></div><!-- End .mb-3 -->

        <div class="row">
            <div class="col-md-6">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-7.jpg') }}" alt="Banner img desc">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white d-none d-sm-block"><a href="#">Spring Sale is
                                Coming</a></h4><!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#">Floral T-shirts and Vests <br><span>Spring
                                    Sale</span></a></h3><!-- End .banner-title -->
                        <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-md-6 -->

            <div class="col-md-6">
                <div class="banner banner-overlay">
                    <a href="#">
                        <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-8.jpg') }}" alt="Banner img desc">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white d-none d-sm-block"><a href="#">Amazing Value</a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#">Upgrade and Save <br><span>On The Latest
                                    Apple Devices</span></a></h3><!-- End .banner-title -->
                        <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner banner-overlay -->
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->

        <div class="mb-3"></div><!-- End .mb-3 -->

        @include('themes.molla.home.with_banner_3')


        <div class="mb-3"></div><!-- End .mb-3 -->

        @include('themes.molla.home.with_banner_4')

        <div class="mb-3"></div><!-- End .mb-3 -->

        <div class="icon-boxes-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-rocket"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                <p>Orders $50 or more</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-rotate-left"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                                <p>Within 30 days</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-info-circle"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                                <p>When you sign up</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-life-ring"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                                <p>24/7 amazing services</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container-fluid -->
        </div><!-- End .icon-boxes-container -->

        <div class="mb-5"></div><!-- End .mb-5 -->
    </div><!-- End .col-lg-9 col-xxl-10 -->

    <aside class="col-xl-3 col-xxl-2 order-xl-first">
        <div class="sidebar sidebar-home">
            <div class="row">
                <div class="col-sm-6 col-xl-12">
                    <div class="widget widget-banner">
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-11.jpg') }}" alt="Banner img desc">
                            </a>

                            <div class="banner-content banner-content-top banner-content-right text-right">
                                <h3 class="banner-title text-white"><a href="#">Maximum Comfort <span>Sofas -20%
                                            Off</span></a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .widget widget-banner -->
                </div><!-- End .col-sm-6 col-xl-12 -->

                @include('themes.molla.home.best_seller')


                @include('themes.molla.home.special_offer')


                <div class="col-sm-6 col-xl-12">
                    <div class="widget widget-banner">
                        <div class="banner banner-overlay">
                            <a href="#">
                                <img src="{{ asset('themes/molla/assets/images/demos/demo-14/banners/banner-12.jpg') }}" alt="Banner img desc">
                            </a>

                            <div class="banner-content banner-content-top">
                                <h3 class="banner-title text-white"><a href="#">Take Better Photos
                                        <br><span>With</span> Canon EOS <br><span>Up To 20% Off</span></a></h3>
                                <!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .widget widget-banner -->
                </div><!-- End .col-sm-6 col-lg-12 -->

                @include('themes.molla.home.blog')

            </div><!-- End .row -->
        </div><!-- End .sidebar sidebar-home -->
    </aside><!-- End .col-lg-3 col-xxl-2 -->
</div><!-- End .row -->



@include('themes.molla.home.popup')

@endsection

@section('js')
<script src="themes/molla/assets/js/demos/demo-14.js"></script>
@endsection