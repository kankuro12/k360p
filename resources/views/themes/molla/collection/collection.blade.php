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
            <div class="banner-group">
                <div class="row">
                @foreach(\App\model\admin\Collection::all() as $col)
                    <div class="col-sm-6 col-lg-{{$col->rows}}">
                        <div class="banner banner-overlay banner-lg">
                            <a href="{{ route('collection.detail',$col->collection_id) }}">
                                <img src="{{ asset($col->collection_image) }}" alt="Banner">
                            </a>

                            <div class="banner-content banner-content-bottom">
                                <h3 class="banner-title text-white"><a href="{{ route('collection.detail',$col->collection_id) }}">{{ $col->collection_name }}</a></h3><!-- End .banner-title -->
                                <h4 class="banner-subtitle text-white"><a >{{ $col->collection_description }}</a></h4><!-- End .banner-subtitle -->
                                <a href="{{ route('collection.detail',$col->collection_id) }}" class="btn btn-outline-white banner-link mt-1">Shop Now</a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-4 -->
                    @endforeach
                </div><!-- End .row -->
            </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection