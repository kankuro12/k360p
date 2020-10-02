@php
$product=$order->product;

@endphp
<div class="card" style="margin: 5px 0;padding: 5px ;box-shadow: none;">
    <div class="row" style="margin: 0;">
        <div class="col-md-2" style="border-right:#f1f1f1 solid 1px;">
            <div style="">

                <img src="" data-loaded='0' class="sid-{{ $sid }}" data-src="{{ asset($product->product_images) }}" />
            </div>
        </div>
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right"> <strong>Name:</strong> </div>
                        <div class="col-md-9">{{ $product->product_name }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right"> <strong>Quantity:</strong> </div>
                        <div class="col-md-3">{{ $order->qty }}</div>
                        <div class="col-md-3 text-right"> <strong>Rate:</strong> </div>
                        <div class="col-md-3">{{ $order->rate }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right"> <strong>Quantity:</strong> </div>
                        <div class="col-md-3">{{ $order->qty }}</div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right"> <strong>Variant:</strong> </div>
                        <div class="col-md-3">{{ $order->variant() }}</div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right"> <strong>Variant:</strong> </div>
                        <div class="col-md-3">{{ $order->variant() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
