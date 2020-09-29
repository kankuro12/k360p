@php
$ad=$data->getElement();
@endphp
@if ($ad != null)
    <div class="banner banner-overlay">
        <a href="#">
            <img src="{{asset($ad->image1)}}" alt="Banner img desc">
        </a>

        <div class="banner-content">
            
            <a href="{{$ad->link1}}" class="banner-link" style="margin-top:60%;">{{$ad->link2}} <i class="icon-long-arrow-right"></i></a>
        </div><!-- End .banner-content -->
    </div><!-- End .banner -->
@endif
