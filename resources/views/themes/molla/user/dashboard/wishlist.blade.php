@extends('themes.molla.layouts.app')
@section('title','User Wishlist')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Wishlist<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>

            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('themes.molla.user.dashboard.header')

                    <div class="col-md-8 col-lg-9">
                        <div style="margin:2rem 0;">
                            @include('themes.molla.layouts.message')
                        </div>
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab-order" role="tabpanel" aria-labelledby="tab-order-link">
                               @php 
                                    $wishlistCount = \App\Wishlist::where('user_id',Auth::user()->id)->count();
                               @endphp
                               @if($wishlistCount>0)
                                <table class="table table-wishlist table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($wishlist as $list)
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="{{ route('product.detail',$list->product_id)}}">
                                                            <img src="{{ asset($list->product->product_images) }}" alt="Product image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="{{ route('product.detail',$list->product_id)}}">{{ $list->product->product_name }}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col">NPR.{{ $list->product->mark_price }}</td>

                                            <td class="remove-col"><a href="{{ route('user.wishlist.remove',$list->id)}}" class="btn-remove" title="Remove"><i class="icon-close"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               @else
                                <p>Products are not added yet!!!!</p>
                               @endif
                            </div><!-- .End .tab-pane -->

                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection