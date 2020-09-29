@extends('themes.molla.layouts.app')
@section('title','User Account Detail')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Detail</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                            
                            <div class="tab-pane fade show active" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="{{ route('account.detail') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" name="fname" value="{{ $user->fname }}" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" name="lname" value="{{ $user->lname }}" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Secondary Email address *</label>
                                    <input type="email" class="form-control" name="secondary_email" >

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Telephone *</label>
                                            <input type="text" class="form-control" name="mobile_number" value="{{ $user->mobile_number }}" required>
                                        </div><!-- End .col-sm-6 -->
                                     
                                        <div class="col-sm-6">
                                            <label>Date Of Birth *</label>
                                            <input type="date" class="form-control" name="dob">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Province *</label>
                                            <select class="form-control" data-live-search="true" id="province_id" name="province" data-style="btn btn-primary " title="Select a Province" data-size="7" style="border:1px solid #b6b6b6;">
                                            <option ></option>
											@foreach (\App\Province::all() as $province)
											<option value="{{ $province->name }}">{{ $province->name }}</option>
											@endforeach
										</select>
                                        </div><!-- End .col-sm-6 -->
                                     
                                        <div class="col-sm-6">
                                            <label>City *</label>
                                            <input type="text" class="form-control" name="city">
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postal Code *</label>
                                            <input type="text" class="form-control" name="postalcode">
                                        </div><!-- End .col-sm-6 -->
                                     
                                        <div class="col-sm-6">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option ></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Select Image *</label>
                                    <input type="file" class="form-control" name="image">

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection