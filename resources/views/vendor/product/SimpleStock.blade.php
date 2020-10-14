<div>
    <form action="{{route('vendor.simple-stock',['product'=>$productdetail->product_id])}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <label >
                Quantity
            </label>
            <input type="number" name="qty" value="{{$productdetail->quantity}}" min="0" step="0.01" class="form-control">
        </div>
        <div class="col-md-12">
            <input type="submit" value="Update Stock" class="btn btn-primary">
        </div>
    </div>
    </form>
</div>