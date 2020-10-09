<div>
    <form action="{{ route('vendor.product-extracharge') }}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $productdetail->product_id }}">
        <div class="row">
            <div class="col-md-4">
                <label>Name</label>
                <input required type="text" class="form-control" name="name" id="name">
            </div>
            <div class="col-md-4">
                <label>Amount</label>
                <input required type="number" step="0.01" class="form-control" name="amount" id="amount" min="0">
            </div>
            <div class="col-md-4">
                <br>
                <input type="submit" value="Add New" class="btn btn-primary>" />
            </div>
        </div>
    </form>
</div>
<hr>
<h4>
    <strong>
        Extra Charges
    </strong>

</h4>

<div>
    <table class="table">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Amount</th>
            <th colspan="2">Action </th>

        </tr>
        @foreach ($productdetail->extracharges as $item)
            <tr>
                <form action="{{ route('admin.product-extracharge-update', ['extracharge' => $item->id]) }}"
                    method="post">
                    <td></td>
                    <td><strong>@csrf
                            <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control"
                                placeholder="Enter Name">
                        </strong> </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="amount" id="amount" value="{{ $item->amount }}"
                            class="form-control" placeholder="Enter Name">

                    </td>
                    <td>
                        <input type="submit" value="Update" class="btn btn-primary" style="width:100%;">
                    </td>
                </form>
                <td>
                    <form
                        action="{{ route('admin.product-extracharge-status', ['extracharge' => $item->id, 'status' => $item->enabled == 1 ? 0 : 1]) }}"
                        method="post">
                        @csrf
                        <input type="submit" value="{{ $item->enabled == 1 ? 'Disable' : 'Enable' }}"
                            class="btn btn-primary">


                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
