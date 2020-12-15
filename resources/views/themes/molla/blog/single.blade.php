@extends('themes.molla.layouts.app')
@section('title','Blog Detail')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog<span>Detail</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog Detail</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{ asset($blog->image)}}" alt="image desc">
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#">{{ $blog->post_by }}</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#">{{ $blog->published }}</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                {{ $blog->title }}
                            </h2><!-- End .entry-title -->

                            <div class="entry-content editor-content">
                                {!! $blog->desc !!}
                            </div><!-- End .entry-content -->

                            <div class="entry-footer row no-gutters flex-column flex-md-row">
                                <div class="col-md">
                                    @php
                                    $tags = explode(',',$blog->tag);
                                    @endphp
                                    <div class="entry-tags">
                                        <span>Tags:</span>
                                        @foreach($tags as $t)
                                        <a href="#">{{ $t }}</a>
                                        @endforeach
                                    </div><!-- End .entry-tags -->
                                </div><!-- End .col -->
                            </div><!-- End .entry-footer row no-gutters -->
                        </div><!-- End .entry-body -->


                    </article><!-- End .entry -->
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        @php
                          $other = \App\Blog::where('id','!=',$blog->id)->get();
                        @endphp

                        <div class="widget">
                            <h4>Other Posts</h4><!-- End .widget-title -->

                            <ul class="posts-list">
                                @foreach($other as $o)
                                <li>
                                    <figure>
                                        <a href="{{ url('blog/detail',$o->id)}}">
                                            <img src="{{ asset($o->image)}}" alt="post" style="height:80px; width:80px;">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>{{ $o->published }}</span>
                                        <h4><a href="{{ url('blog/detail',$o->id)}}">{{ $o->title }}</a></h4>
                                    </div>
                                </li>
                                @endforeach
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->


    </div>
</main><!-- End .main -->
@endsection