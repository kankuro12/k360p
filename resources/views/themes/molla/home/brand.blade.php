<div class="mb-5"></div><!-- End .mb-3 -->
<div class="container">
    <div class="owl-carousel mb-5 owl-simple owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                        &quot;nav&quot;: false, 
                        &quot;dots&quot;: true,
                        &quot;margin&quot;: 30,
                        &quot;loop&quot;: false,
                        &quot;responsive&quot;: {
                            &quot;0&quot;: {
                                &quot;items&quot;:2
                            },
                            &quot;420&quot;: {
                                &quot;items&quot;:3
                            },
                            &quot;600&quot;: {
                                &quot;items&quot;:4
                            },
                            &quot;900&quot;: {
                                &quot;items&quot;:5
                            },
                            &quot;1024&quot;: {
                                &quot;items&quot;:6
                            },
                            &quot;1280&quot;: {
                                &quot;items&quot;:6,
                                &quot;nav&quot;: true,
                                &quot;dots&quot;: false
                            }
                        }
                    }">


        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1398px;">
            @foreach(\App\model\admin\Brand::all() as $b)
                <div class="owl-item active" style="width: 169.667px; margin-right: 30px;"><a href="{{ route('shop-by-brand',$b->brand_id)}}" class="brand" title="{{ $b->brand_name }}">
                        <img src="{{asset($b->brand_logo) }}" alt="Brand Name">
                    </a>
                </div>
            @endforeach
            </div>
        </div>
        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div>
        <div class="owl-dots disabled"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button><button role="button" class="owl-dot"><span></span></button></div>
    </div><!-- End .owl-carousel -->
</div>