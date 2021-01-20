<div class="row " >
    @foreach ($products as $p)
        <div class="col-6 mb-2 p-1">
            @include(\App\Setting\HomePage::theme('elements.mobile_simple_product'),['product'=>$p])
        </div>
    @endforeach
</div>
