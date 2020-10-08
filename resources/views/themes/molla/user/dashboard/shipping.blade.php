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
@foreach($charges as $charge)
<div class="row">
    <div class="col-md-9">
        <div>
            {{$i}}. {{$charge['product']['product_name']}}
        </div>
        <div>
            {{$charge['type']}}
        </div>
        <div>
            {{$charge['show']}}
        </div>
    </div>
    <div class="col-md-3">
        {{$charge['price']}}
    </div>
</div>
<hr class="m-1">
@php
$totalShippingCharge += $charge['price'];
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