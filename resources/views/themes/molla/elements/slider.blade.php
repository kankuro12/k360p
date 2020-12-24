@php
$group=$data->getElement();
@endphp
{{-- <style>
    .owl-item {height: 0;}
.owl-item.active {height: auto;}
</style> --}}
<div class="intro-slider-container slider-container-ratio mb-2 ">
    <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
            "nav": true,
            "dots": true,
            "autoHeight":true,
            "autoplay":true
        }'>
        @foreach ($group->sliders as $slider)
            <div class="intro-slide">
                {{-- <figure class="slide-image">
                </figure><!-- End .slide-image --> --}}
                <picture>
                    <source media="(max-width: 480px)" srcset="{{ asset($slider->mobile) }}">
                    <img src="{{ asset($slider->slider_image) }}" alt="Image Desc" style="width:100%;">
                </picture>

                <div class="intro-content">
                    {{-- <h3 class="intro-subtitle">{!! $slider->secondary_text !!}</h3><!-- End .h3 intro-subtitle --> --}}
                    <h1 class="intro-title text-white">
                        {!! $slider->primary_text !!}
                    </h1><!-- End .intro-title -->

                    <div class="intro-text text-white">
                        {!! $slider->secondary_text !!}
                    </div><!-- End .intro-text -->
                    @if($slider->button_status == 1)
                     <a href="{{ $slider->link_text }}" class="btn btn-primary" style="color:{{$slider->button_color}};background:{{$slider->button_bg}};border:none;">
                        <span>{!! $slider->button_text !!}</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                    @endif
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->
        @endforeach

    </div><!-- End .intro-slider owl-carousel owl-simple -->

    <span class="slider-loader"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->
