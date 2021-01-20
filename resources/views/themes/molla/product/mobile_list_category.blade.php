<div class="row m-0 row m-0 mr-4 mt-1">
    @foreach ($products as $p)
        <div class="col-6 p-0 p-1">
            @include(\App\Setting\HomePage::theme('elements.mobile_simple_product'),['product'=>$p])
        </div>
    @endforeach
</div>
