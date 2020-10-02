<div>
    @php
        $product=$order->product;

    @endphp
    <div class="card" style="margin: 5px 0;padding: 10px;">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 text-right"> <strong>Name</strong> </div>
                    <div class="col-md-9">{{$product->product_name}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 text-right"> <strong>Quantity</strong> </div>
                    <div class="col-md-3">{{$order->qty}}</div>
                    <div class="col-md-3 text-right"> <strong>Rate</strong> </div>
                    <div class="col-md-3">{{$order->rate}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 text-right"> <strong>Quantity</strong> </div>
                    <div class="col-md-3">{{$order->qty}}</div>
                   
                </div>
            </div>
        </div>
    </div>
</div>