<table class="table">

    <tr>
        <th>
            <input type="checkbox" onchange="checkAll()">
        </th>
        <th>
            Image
        </th>
        <th>
            Name
        </th>
        <th>

        </th>
    </tr>
    @foreach ($products as $product)
        
    <tr>
        <td>
            <input type="checkbox" value="{{$product->product_id}}" class="product_id">
        
        </td>
        <td>
            <img src="{{asset($product->product_images)}}" style="max-width:75px;border-radius: 5px;" alt="">
        </td>
        <th>
            {{$product->product_name}}
        </th>
        <td>
            <button onclick="addItem({{$product->product_id}})" class="btn btn-primary btn-sm">Add>></button>
        </td>
    </tr>
    @endforeach
</table>