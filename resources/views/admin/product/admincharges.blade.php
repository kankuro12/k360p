<div>
    <form action="{{route('admin.admin-charge',['product'=>$productdetail->product_id])}}" method="post">
    @csrf
    <table class="table">
        <tr>
            <td>
                <strong>Referal Charge (%)</strong>
            </td>
            <td>
                <input type="number" name="rc" id="rc" class="form-control" min="0"  max="100" value="{{$productdetail->referalcharge}}">
            </td>
        </tr>
        <tr>
            <td>
                <strong>Closing Charge</strong>
            </td>
            <td>
                <input type="number" name="cc" id="cc" class="form-control" min="0" value="{{$productdetail->closingcharge}}">
            </td>
        </tr>
        <tr>
            <td>
                <strong>Packaging Charge</strong>
            </td>
            <td>
                <input type="number" name="pc" id="pc" class="form-control" min="0" value="{{$productdetail->packagingcharge}}">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Save Charges" class="btn btn-primary">
            </td>
        </tr>
    </table>
    </form>
</div>