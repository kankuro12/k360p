@extends('themes.molla.layouts.app')
@section('title','User Dashboard')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                    @endphp
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">User Info</h3><!-- End .card-title -->
                                                <p>{{ $user->fname}} {{ $user->lname}}<br>
                                                    {{ $user->mobile_number}}<br>
                                                    {{ $user->user->email }}<br>
                                                    {{ $user->province }}<br>
                                                    {{ $user->city }}<br>
                                                    {{ $user->postalcode }} : Postalcode<br>
                                                    {{ $user->dob }}<br>
                                                    {{ $user->gender }}<br>
                                                </p>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->

                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ asset($user->profile_img) }}" alt="user_image" class="img-thumbnail">
                                    </div>
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