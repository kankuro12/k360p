<div>
    <hr>
    <h4>
        <strong>Shipping Price</strong>
    </h4>
    @php
        $arr=$shippingprice->toArray();
    @endphp
    
    <?php $i=0;?>
    @foreach (\App\Setting\VendorOption::deliverrange as $item)
            <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label >{{$item}}</label>
                <input class="form-control"  type="number" name="amount_{{$i}}" id="amount_{{$i}}" value="{{$arr['amount_'.$i]}}" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Type</label>
                <input type="text"  class="form-control" readonly value="{{\App\Setting\VendorOption::shippingoption[$arr['type_'.$i]]}}">
                {{-- <select class="selectpicker" data-live-search="true" id="type_{{$i}}" name="type_{{$i}}"
                    data-style="btn btn-primary " title="Select A Price Method" data-size="6" required >
                    @foreach (\App\Setting\VendorOption::shippingoption as $key=>$option)
                        <option value="{{$key}}" {{$arr['type_'.$i]==$key?"selected":""}}>
                            {{ $option}}</option>
                    @endforeach
                </select> --}}
            </div>
        </div>
        
    </div>
    <?php $i+=1; ?>
        @endforeach
       
</div>