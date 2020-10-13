@extends('themes.molla.layouts.app')
@section('title','Collection Group')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">About Us<span>Who we are</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">About Us</a></li>
             
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
           
          @php
              $about=\App\AboutUs::first();
          @endphp
           
           <div style="min-height: 400px;">
                @if ($about!=null)
                    {!!$about->full!!}
                @endif
           </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection