<div>
    <form action="{{ url('vendor/product-shipping/' . $productdetail->product_id) }}" method="post">
        @php

            $shipping=$productdetail->shipping();

        @endphp
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label for="">Shipping Method</label>
                <select class="selectpicker" data-live-search="true" id="shipping_class_id" name="shipping_class_id"
                    data-style="btn btn-primary " title="Select A shipping Method" data-size="3" required onchange="
                    $('#w_class').text($(this).find(':selected').attr('data-wclass'));
                    $('.d_class').text($(this).find(':selected').attr('data-dclass'));
                    ">
                    @foreach (App\ShippingClass::all() as $item)
                        <option  data-wclass="{{ $item->weightclass }}" data-dclass="{{$item->dimensionclass}}" value="{{ $item->id }}" {{$shipping!=null?($shipping->shipping_class_id==$item->id?'selected':''):''}}>
                            {{ $item->name}}</option>
                    @endforeach
                </select>

            </div>

        </div>
        <div >
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Weight <span id="w_class">{{$shipping!=null?$shipping->shipping->weightclass:""}}</span></label>
                        <input required type="number" step="0.01" name="weight" class="form-control" value="{{$shipping!=null?$shipping->weight:""}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> Length <span class="d_class">{{$shipping!=null?$shipping->shipping->dimensionclass:""}}</span></label>
                        <input required type="number" step="0.01" name="l" class="form-control" value="{{$shipping!=null?$shipping->l:""}}">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> Height <span class="d_class">{{$shipping!=null?$shipping->shipping->dimensionclass:""}}</span></label>
                        <input required type="number" step="0.01" name="h" class="form-control" value="{{$shipping!=null?$shipping->h:""}}">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> width <span class="d_class">{{$shipping!=null?$shipping->shipping->dimensionclass:""}}</span></label>
                        <input required type="number" step="0.01" name="w" class="form-control" value="{{$shipping!=null?$shipping->w:""}}">

                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary">Save Shipping Detail</button>
        </div>
    </form>
</div>

@if ($shipping!=null)
    @php
        $shippingprice=$shipping->shippingprice();
    @endphp
    @if ($shippingprice!=null)
        @include('vendor.product.updateshippingprice',['$shippingprice'=>$shippingprice])
    @endif
@endif
