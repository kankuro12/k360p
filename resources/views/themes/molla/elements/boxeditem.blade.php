<div class="tab-pane p-0 fade show {{$i==0?"active":""}}" id="boxeditems_{{ $item->id }}" role="tabpanel"
    aria-labelledby="trending-all-link">
    <div class="owl-carousel owl-full carousel-equal-height  cat-owl"  data-owl='{
        "loop":false,
        "responsive":{
            "0": {
                "items":1               
            },
            "480": {
                "items":{{$item->mobile}}
            },
            "768": {
                "items":{{$item->tab}}
            },
            "992": {
                "items":{{$item->tab}}
            },
            "1200": {
                "items":{{$item->laptop}}
            },
            "1600": {
                "items":{{$item->tv}}
            }
        }}'>

        @foreach ($item->products() as $product) 
            @include('themes.molla.elements.product',$product)
        @endforeach
    </div><!-- End .owl-carousel -->
</div>
