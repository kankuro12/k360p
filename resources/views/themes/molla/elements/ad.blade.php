@php
$ad=$data->getElement();
@endphp
@if ($ad != null)
    <div class="banner banner-overlay d-none d-md-block">
        <a href="#">
            <picture>
                <source media="(max-width: 480px)" srcset="{{ asset($ad->image2) }}">
                {{-- <img src="{{ asset($slider->slider_image) }}" alt="Image Desc" style="width:100%;"> --}}
                <img src="{{asset($ad->image1)}}" alt="Banner img desc">
            </picture>
        </a>

        <div class="banner-content">
            @if($ad->button_status == 1)
             <a href="{{$ad->link1}}" class="banner-link" style="margin-top:60%; background:{{$ad->button_bg_color}}; color: {{ $ad->button_text_color}};">{{$ad->link2}} <i class="icon-long-arrow-right"></i></a>
            @endif
        </div><!-- End .banner-content -->
    </div><!-- End .banner -->
@endif
