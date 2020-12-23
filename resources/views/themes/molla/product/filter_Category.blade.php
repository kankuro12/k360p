<div class="filter-item">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="cat-{{$category->cat_id}}" value="{{$category->cat_id}}">
        <label class="custom-control-label" for="cat-{{$category->cat_id}}">{{$category->cat_name}}</label>
        @if($category->count() >0)
            <a style="color:black;float:right;" data-toggle="collapse" href="#cat-container-{{$category->cat_id}}" role="button" aria-expanded="true" aria-controls="cat-container-{{$category->cat_id}}">
                c
            </a>
        @endif
    </div><!-- End .custom-checkbox -->
    {{-- <span class="item-count">3</span> --}}
</div><!-- End .filter-item -->
@if($category->count() >0)
    <div class="collapse pl-4" id="cat-container-{{$category->cat_id}}">
        @foreach ($category->child() as $childcat)
            @include(\App\setting\HomePage::theme('product.filter_Category'),['category'=>$childcat])
        @endforeach
    </div>

@endif
