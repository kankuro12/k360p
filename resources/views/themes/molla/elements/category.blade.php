@php
$cat=$data->getElement();
@endphp
@if ($cat != null)
    @php
    $category=\App\model\admin\Category::find($cat->category_id);
    $categories=$category->childList();
    $products=\App\model\admin\Product::whereIn('category_id',$categories)->orderBy($cat->orderby,$cat->order==0?"asc":"desc")->take($cat->count)->get();
    // dd($categories);
    @endphp

    <div class="d-none d-md-block">
    @if ($cat->showtitle==1)
        <h3 class="mb-md-1 mt-md-1 "><strong>{{$data->name}}</strong></h3>
        <div class="row mb-1">
            <div class="col-md-4 p-0" >
                <div style="height:1px;background:red;"></div>
            </div>
            <div class="col-md-4 p-0" >
                <div style="height: 1px;background:blue;"></div>
            </div>
            <div class="col-md-4 p-0" >
                <div style="height: 1px;background:green;"></div>
            </div>
        </div>
    @endif
    </div>
    <div class="owl-carousel owl-full carousel-equal-height cat-owl d-none d-md-block"
    data-owl='{
        "responsive":{
            "0": {
                "items":{{$cat->mobile}}
            },
            "480": {
                "items":{{$cat->mobile}}
            },
            "768": {
                "items":{{$cat->tab}}
            },
            "992": {
                "items":{{$cat->tab}}
            },
            "1200": {
                "items":{{$cat->laptop}}
            },
            "1600": {
                "items":{{$cat->tv}}
            }
        }}'>
        @foreach ($products as $product)
            @include('themes.molla.elements.product',$product)
        @endforeach

    </div><!-- End .owl-carousel -->
@endif
