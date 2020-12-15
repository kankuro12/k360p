@extends('themes.molla.layouts.app')
@section('title','Blog List')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog<span>List</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog List</a></li>

            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="mt-3"></div>
            <div class="entry-container max-col-4" data-layout="fitRows">
                @foreach(\App\Blog::latest()->get() as $b)
                <div class="entry-item lifestyle shopping col-sm-6 col-md-4 col-lg-3">
                    <article class="entry entry-grid text-center">
                        <figure class="entry-media">
                            <a href="single.html">
                                <img src="{{ asset($b->image) }}" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <a href="#">{{ $b->published }}</a>
                                <span class="meta-separator">|</span>
                                <a href="#">By : {{ $b->post_by}}</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="{{ route('public.blog.detail',$b->id)}}">{{ $b->title }}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-content">
                                <p>{!! Str::limit($b->desc,200) !!}</p>
                                <a href="{{ route('public.blog.detail',$b->id)}}" class="read-more">Continue Reading</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .entry-item -->
                @endforeach
            </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection