@extends('themes.molla.layouts.app')
@section('title', 'OnSale Product')
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

        <style>
            /* ribbon style */

            .ribbon-wrapper {
                position: relative;
                border-bottom: 10px solid #ccc;
                border-top: 0px solid #ccc;
                -moz-border-bottom-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
                -webkit-border-bottom-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
                -moz-border-top-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
                -webkit-border-top-colors: rgba(0, 0, 0, 0.02) rgba(0, 0, 0, 0.04) rgba(0, 0, 0, 0.06) rgba(0, 0, 0, 0.08) rgba(0, 0, 0, 0.10) rgba(0, 0, 0, 0.12) rgba(0, 0, 0, 0.14) rgba(0, 0, 0, 0.16) rgba(0, 0, 0, 0.18) rgba(0, 0, 0, 0.20);
            }

            .ribbon-front {
                background-color: #f93c3c;
                height: 80px;
                width: calc(100% + 22px);
                position: relative;
                left: -20px;
                z-index: 2;
            }

            .ribbon-front,
            .ribbon-back-left,
            .ribbon-back-right {
                -moz-box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.55);
                -khtml-box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.55);
                -webkit-box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.55);
                -o-box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.55);
            }

            .ribbon-edge-topleft,
            .ribbon-edge-topright,
            .ribbon-edge-bottomleft,
            .ribbon-edge-bottomright {
                position: absolute;
                z-index: 1;
                border-style: solid;
                height: 0px;
                width: 0px;
            }

            .ribbon-edge-topleft,
            .ribbon-edge-topright {}

            .ribbon-edge-bottomleft,
            .ribbon-edge-bottomright {
                top: 80px;
            }

            .ribbon-edge-topleft,
            .ribbon-edge-bottomleft {
                left: -20px;
                border-color: transparent #f93c3c transparent transparent;
            }

            /* .ribbon-edge-topleft,
                .ribbon-edge-bottomleft {
                    left: -20px;
                    border-color: transparent #99c transparent transparent;
                } */

            .ribbon-edge-topleft {
                top: 0px;
                border-width: 0px 20px 0 0;
            }

            .ribbon-edge-bottomleft {
                border-width: 0 20px 10px 0;
            }

            .ribbon-edge-topright,
            .ribbon-edge-bottomright {
                left: 20px;
                border-color: transparent transparent transparent #99c;
            }

            .ribbon-edge-topright {
                top: 0px;
                border-width: 0px 0 0 0px;
            }

            .ribbon-edge-bottomright {
                border-width: 0 0 0px 0px;
            }

            .ribbon-back-left {
                position: absolute;
                top: 10px;
                left: -10px;
                width: 10px;
                height: 80px;
                background-color: #0000006b;
                z-index: 0;
            }

            .ribbon-back-right {
                position: absolute;
                top: 0px;
                right: 0px;
                width: 0px;
                height: 80px;
                z-index: 0;
            }

        </style>
        <div class="page-content">
            <div class="container">

                <div class="container featured mt-4 pb-2">

                    <div class="row">
                        @foreach (\App\model\admin\Onsell::all() as $sell)
                            @php
                            $today = date('yy-m-d');
                            $startDate = date('yy-m-d',strtotime($sell->started_at));
                            $endDate = date('yy-m-d',strtotime($sell->end_at));
                            @endphp
                            @if ($startDate <= $today && $endDate >= $today)
                                {{-- <div class="col-lg-3 order-md-first p-0" style="background:#CEBDB5">

                                    <div class="ribbon-wrapper" style="border-bottom-width: 0px;">
                                        <div class="ribbon-front" >
                                            <h3 class="text-white text-center pt-2">{!! $sell->sell_name !!}</h3>
                                            <!-- ribbon text goes here -->
                                        </div>
                                        <div class="ribbon-edge-topleft"></div>
                                        <div class="ribbon-edge-topright"></div>
                                        <div class="ribbon-edge-bottomleft"></div>
                                        <div class="ribbon-edge-bottomright"></div>
                                        <div class="ribbon-back-left"></div>
                                        <div class="ribbon-back-right"></div>
                                    </div>

                                    <div class="pt-2 pb-2">
                                        <div id="clock" class="product-countdown" data-until="{{ $sell->end_at }}"
                                            data-relative="false" data-labels-short="true"></div>
                                    </div>
                                </div><!-- End .col-lg-3 --> --}}
                                <div class="col-lg-12">
                                    <div class="d-block d-md-flex">

                                        <div class="heading-left">
                                            <h2 class="title text-danger text-center" >{{ $sell->sell_name }} </h2><!-- End .title -->
                                        </div><!-- End .heading-left -->
                                        <div class="heading-right" style="width:320px;">
                                            <div class="product-countdown" data-until="{{$sell->end_at}}" data-relative="false" data-labels-short="true" style="position:relative;background-color:#dc3545;"></div>
                                        </div><!-- End .heading-left -->
                                    </div>

                                    <hr class="mt-1 mb-2">
                                   
                                    <div class="products mb-3">
                                        <div class="row ">
                                            @php
                                            $sell_product =
                                            \App\model\admin\Sell_product::where('sell_id',$sell->sell_id)->take(4)->get();
                                            $sell_productCount =
                                            \App\model\admin\Sell_product::where('sell_id',$sell->sell_id)->count();
                                            @endphp
                                            @foreach ($sell_product as $p)
                                                <div class="col-12 col-md-4 col-lg-4 col-xl-3">
                                                    @include(\App\Setting\HomePage::theme('elements.product'),['product'=>$p->product])
                                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                            @endforeach
                                        </div><!-- End .row -->
                                        @if ($sell_productCount >= 4)
                                            <div class="load-more-container text-center">
                                                <a href="{{ route('public.sale.detail', $sell->sell_id) }}"
                                                    class="btn btn-outline-darker btn-load-more">More Products <i
                                                        class="icon-refresh"></i></a>
                                            </div><!-- End .load-more-container -->
                                        @endif
                                    </div><!-- End .products -->
                                </div>
                            @endif
                        @endforeach

                    </div><!-- End .row -->
                </div>

            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main>
@endsection
@section('js')

@endsection
