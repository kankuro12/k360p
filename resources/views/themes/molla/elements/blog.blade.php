@php
$blog=$data->getElement();
@endphp
@if($blog != null)
<div class="blog-posts bg-light pt-4 pb-7">
    <div class="container">
        <h2 class="title">From Our Blog</h2><!-- End .title-lg text-center -->

        <div class="owl-carousel owl-simple owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                                &quot;nav&quot;: false, 
                                &quot;dots&quot;: true,
                                &quot;items&quot;: 3,
                                &quot;margin&quot;: 20,
                                &quot;loop&quot;: false,
                                &quot;responsive&quot;: {
                                    &quot;0&quot;: {
                                        &quot;items&quot;:1
                                    },
                                    &quot;600&quot;: {
                                        &quot;items&quot;:2
                                    },
                                    &quot;992&quot;: {
                                        &quot;items&quot;:3
                                    },
                                    &quot;1280&quot;: {
                                        &quot;items&quot;:4,
                                        &quot;nav&quot;: true, 
                                        &quot;dots&quot;: false
                                    }
                                }
                            }">
            <!-- End .entry -->

            <!-- End .entry -->

            <!-- End .entry -->

            <!-- End .entry -->

            <!-- End .entry -->
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1485px;">
                    @foreach($blog as $b)
                    <div class="owl-item active" style="width: 277px; margin-right: 20px;">
                        <article class="entry">
                            <figure class="entry-media">
                                <a href="#">
                                    <img src="{{ asset($b->blog->image) }}" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-meta">
                                    <a href="#">{{ $b->blog->published}}</a>, By : {{ $b->blog->post_by }}
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="{{ route('public.blog.detail',$b->blog->id)}}">{{ $b->blog->title }}</a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <p>{!! Str::limit($b->blog->desc,200) !!}</p>
                                    <a href="{{ route('public.blog.detail',$b->blog->id)}}" class="read-more">Read More</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div>
            <div class="owl-dots disabled"></div>
        </div><!-- End .owl-carousel -->
        <div class="more-container text-center mt-1 mb-0">
            <a href="{{ route('public.blog')}}" class="btn btn-outline-lightgray btn-more btn-round"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
        </div>
    </div><!-- End .container -->
</div>

@endif