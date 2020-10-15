@extends('themes.molla.layouts.app')
@section('title','Password Reset Sucess')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Account<span>Password Reset</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Account</a></li>
                <li class="breadcrumb-item"><a href="#">Password Reset</a></li>
             
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">           
           <div class="p-5">
                <div class="card p-5 text-center b-0 shadow" >
                   <h5>
                       A Password Reset link Has Been sent to Your Email. Please Check your Email!!
                    </h5> 
                </div>
           </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection