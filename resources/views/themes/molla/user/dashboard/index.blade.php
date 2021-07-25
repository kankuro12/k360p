@extends('themes.molla.user.dashboard.app')
@section('title','User Dashboard')
@section('content')
@php
$user = \App\model\VendorUser\VendorUser::where('user_id',Auth::user()->id)->first();
$total_ref = App\model\OrderItem::where('referal_id',Auth::user()->id)->count();
@endphp
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>User Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/')}}"><i class="zmdi zmdi-home"></i> Home </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">User Dashboard</li>
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

                <div class="col-lg-5 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon indigo"><i class="zmdi zmdi-hc-fw"></i></div>
                                    <h4 class="mt-3">{{ $pendingCount }}</h4>
                                    <span class="text-muted">Pending Order(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon indigo"><i class="zmdi zmdi-hc-fw"></i></div>
                                    <h4 class="mt-3">{{ $acceptCount }}</h4>
                                    <span class="text-muted">Accepted Order(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon indigo"><i class="zmdi zmdi-hc-fw"></i></div>
                                    <h4 class="mt-3">{{ $receivCount }}</h4>
                                    <span class="text-muted">Received Order(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon indigo"><i class="zmdi zmdi-hc-fw"></i></div>
                                    <h4 class="mt-3">{{ $rejectCount }}</h4>
                                    <span class="text-muted">Rejected Order(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon indigo"><i class="zmdi zmdi-hc-fw"></i></div>
                                    <h4 class="mt-3">{{ $returnCount }}</h4>
                                    <span class="text-muted">Returned Order(s)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card w_data_1">
                                <div class="body">
                                    <div class="w_icon indigo"><i class="zmdi zmdi-favorite"></i></div>
                                    <h4 class="mt-3">{{ $total_ref }}</h4>
                                    <span class="text-muted">My Referal(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
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
