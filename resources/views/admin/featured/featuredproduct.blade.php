<tr id="item-{{$product->product_id}}">
    <td>
        <img src="{{asset($product->product_images)}}" style="max-width:75px;border-radius: 5px;" alt="">
    </td>
    <td>
        {{$product->product_name}}
    </td>
    <td>
        <button class="btn btn-danger btn-sm" onclick="removeItem({{$product->product_id}})">
            remove
        </button>
    </td>
</tr>