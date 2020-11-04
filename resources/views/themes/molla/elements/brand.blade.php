@php
$brand=$data->getElement();
@endphp
@if($brand != null)
<div class="mb-4"></div><!-- End .mb-5 -->
<div class="owl-carousel owl-simple brands-carousel owl-loaded owl-drag" data-toggle="owl" data-owl-options="{
                                &quot;nav&quot;: false, 
                                &quot;dots&quot;: false,
                                &quot;margin&quot;: 20,
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
                                    &quot;1600&quot;: {
                                        &quot;items&quot;:6,
                                        &quot;nav&quot;: true
                                    }
                                }
                            }">


    <div class="owl-stage-outer">
        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1249px;">
        @foreach($brand as $b)
            <div class="owl-item active" style="width: 158.35px; margin-right: 20px;"><a href="{{ route('shop-by-brand',$b->brand_id) }}" title="{{ $b->brand->brand_name }}" class="brand">
                    <img src="{{ asset($b->brand->brand_logo) }}" alt="Brand Name">
                </a>
            </div>
        @endforeach
        </div>
    </div>
    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i class="icon-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="icon-angle-right"></i></button></div>
    <div class="owl-dots disabled"></div>
</div>
<div class="mb-4"></div><!-- End .mb-5 -->

@endif