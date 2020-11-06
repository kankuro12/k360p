@extends('themes.molla.user.dashboard.app')
@section('title','User Account Detail')
@section('css')
<!-- <script src="{{ asset('themes/userdashboard/plugins/dropify/js/dropify.min.js') }}"></script> -->
<link href="{{ asset('themes/userdashboard/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/userdashboard/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection
@section('content')
@php
$user = \App\model\VendorUser\VendorUser::where('user_id',Auth::user()->id)->first();
@endphp

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Account Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.account.profile') }}"><i class="zmdi zmdi-home"></i> User Dashboard </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Account Detail</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Account</strong> Modify</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('account.detail') }}" method="POST" enctype="multipart/form-data" novalidate="novalidate" id="data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="fname" value="{{ $user->fname }}" placeholder="First Name" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="lname" value="{{ $user->lname }}" placeholder="Last Name" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="secondary_email" placeholder="Secondary Email" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="mobile_number" value="{{ $user->mobile_number }}" placeholder="Phone" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input-group" style="margin-bottom: 1rem;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control datepicker" name="dob" placeholder="DOB" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <select class="form-control" id="province_id" name="province">
                                                <option></option>
                                                @foreach (\App\Province::all() as $province)
                                                <option value="{{ $province->name }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="city" placeholder="City" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="postalcode" placeholder="Postalcode" />
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <select name="gender" class="form-control">
                                                <option></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="body">
                                            <input type="file" name="image" class="dropify" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button onclick='document.getElementById("data").submit();' type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script src="{{ asset('themes/userdashboard/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('themes/userdashboard/js/pages/forms/dropify.js') }}"></script>
<script src="{{ asset('themes/userdashboard/plugins/momentjs/moment.js') }}"></script>
<script src="{{ asset('themes/userdashboard/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('themes/userdashboard/js/pages/forms/basic-form-elements.js') }}"></script>

@endsection