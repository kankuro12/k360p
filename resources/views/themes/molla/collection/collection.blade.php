@extends('themes.molla.layouts.app')
@section('title','Collection Product')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Collection Product<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Collections</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="products mb-3">
                <div class="row">
                  @foreach(\App\model\admin\Collection::all() as $col)
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <span class="product-label label-new">Collection</span>
                                <a href="{{ route('collection.detail',$col->collection_id) }}">
                                    <img src="{{ asset($col->collection_image) }}" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action">
                                    <a href="{{ route('collection.detail',$col->collection_id) }}" class="btn-product btn-cart"><span>Shop Now</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="{{ route('collection.detail',$col->collection_id) }}">{{ $col->collection_name }}</a></h3><!-- End .product-title -->
                                <p>{{ $col->collection_description }}</p>
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                  @endforeach
                </div><!-- End .row -->
            </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection