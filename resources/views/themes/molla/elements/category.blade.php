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


    <div class="owl-carousel owl-full carousel-equal-height " data-owl="{
        
    }">
        @foreach ($products as $product)

            @include('themes.molla.elements.product',$product)
        @endforeach

    </div><!-- End .owl-carousel -->
@endif
