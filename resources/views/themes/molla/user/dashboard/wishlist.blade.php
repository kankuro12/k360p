@extends('themes.molla.user.dashboard.app')
@section('title','User Wishlist')
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Wishlist</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.account.profile') }}"><i class="zmdi zmdi-home"></i> User Dashboard </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Wishlist</li>
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div style="margin:2rem 0;">
                        @include('themes.molla.layouts.message')
                    </div>
                    <div class="card project_list">
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <td>Name</td>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlist as $list)
                                    <tr>
                                        <td>
                                            <img class="rounded avatar" src="{{ asset($list->product->product_images) }}" alt="Product Image">
                                        </td>
                                        <td>
                                            <a class="single-user-name" href="{{ route('product.detail',$list->product_id)}}">{{ $list->product->product_name }}</a><br>
                                        </td>
                                        <td>Rs.{{ $list->product->mark_price }}</td>
                                        <td><a href="{{ route('user.wishlist.remove',$list->id)}}" class="badge badge-danger">Remove</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection