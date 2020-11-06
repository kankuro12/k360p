@extends('themes.molla.user.dashboard.app')
@section('title','User Dashboard')
@section('content')
@php
$user = \App\model\VendorUser\VendorUser::where('user_id',Auth::user()->id)->first();
@endphp
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/')}}"><i class="zmdi zmdi-home"></i> Home </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="{{ route('account.detail') }}" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-edit"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
               
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_2">
                        <div class="img">
                            <img src="{{asset('themes/userdashboard/images/image-gallery/3.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="body">
                            <div class="user">
                                @if($user->profile_img != 'profile.png')
                                   <a class="image" href="#"><img src="{{ asset($user->profile_img) }}" class="rounded-circle img-raised" alt="profile-image"></a>
                                @else
                                   <a class="image" href="#"><img src="{{ asset('images/user/user.png') }}" class="rounded-circle img-raised" alt="profile-image"></a>
                                @endif
                                <div class="details">
                                    <h6 class="mb-0">{{ $user->fname}} {{ $user->lname}}</h6>
                                    <small>Consumer</small>
                                </div>
                            </div>
                            <span class="text-muted">Quality is more improtant than quantity. One home run is much better than doubles.</span>
                            <h6 class="mt-2"><a href="javascript:void(0);" title="">Thank You</a></h6>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <h4 class="text-center">User Information</h4>
                            <hr>
                            <p><strong>Name : </strong> {{ $user->fname}} {{ $user->lname}}</p>
                            <p><strong>Mobile : </strong> {{ $user->mobile_number}}</p>
                            <p><strong>Email : </strong> {{ $user->user->email }}</p>
                            <p><strong>Province : </strong> {{ $user->province }}</p>
                            <p><strong>City : </strong> {{ $user->city }}</p>
                            <p><strong>PostalCode : </strong> {{ $user->postalcode }}</p>
                            <p><strong>DOB : </strong> {{ $user->dob }}</p>
                            <p><strong>Gender : </strong> {{ $user->gender }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection