@extends('themes.molla.layouts.app')
@section('title','User Orders')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Orders<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item "><a href="{{ url('/user/dashboard') }}"> My Account </a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>

            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('themes.molla.user.dashboard.header')
                    @php
                    $user = \App\model\VendorUser\VendorUser::where('user_id',Auth::user()->id)->first();
                    $shipping = \App\model\ShippingDetail::latest()->where('user_id',Auth::user()->id)->get();
                    @endphp
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab-order" role="tabpanel" aria-labelledby="tab-order-link">
                                <div class="row">
                                    @foreach($shipping as $key => $ship)
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title"> Order No. {{ $ship->id }}</h3>
                                                <h5 class="card-title">Shipping Address</h3><!-- End .card-title -->
                                                <p>
                                                    {{ $ship->name }}<br>
                                                    {{ $ship->phone }}<br>
                                                    {{ $ship->email }}<br>
                                                    {{ $ship->province->name }}<br>
                                                    {{ $ship->district->name }}<br>
                                                    {{ $ship->municipality->name }}<br>
                                                    <a href="{{ route('user.order.item',$ship->id)}}">View Order Items</a>
                                                    <hr>
                                                    <strong>Order Message :</strong><br>
                                                    {{ $ship->order_message }}
                                                </p>
                                            </div><!-- End .card-body -->
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection