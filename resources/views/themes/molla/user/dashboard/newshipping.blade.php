<?php $i = 1;
$totalShippingCharge = 0 ?>
<div>
    <table>
        <tr class="summary-total">
            <td>Shipping Charge</td>
            <td>Total</td>
        </tr>
    </table>
</div>
@foreach($bundles as $bundle)
<div class="row">
    <div class="col-md-9">
        <div>
            @foreach ($bundle['product'] as $item)
                <div>
                    {{$item['product']['product_name']}}
                    <input type="hidden" name="shipping_{{$item['product']['product_id']}}" value="{{$bundle['shipping']}}">
                    <input type="hidden" name="bundle_{{$item['product']['product_id']}}" value="{{$item['bundleid']}}">
                </div>

            @endforeach
        </div>
        
    </div>
    <div class="col-md-3">
        {{$bundle['shipping']}}
    </div>
</div>
<hr class="m-1">
@php
$totalShippingCharge += $bundle['shipping'];
@endphp
@endforeach


<div>
    <table>
        <tr class="summary-total">
            <td>Total Shipping Charge</td>
            <td>{{ $totalShippingCharge }}</td>
        </tr>
    </table>
</div>
<input type="hidden" name="shipping_charge" id="totalShipping" value="{{ $totalShippingCharge }}">