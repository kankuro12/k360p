<tr id="item-{{$item->id}}">
    <td>
        <img src="{{asset($item->product->product_images)}}" style="max-width:75px;border-radius: 5px;" alt="">
    </td>
    <td>
        {{$item->product->product_name}}
    </td>
    <td>
        <button class="btn btn-danger btn-sm" onclick="removeItem({{$item->id}})">
            remove
        </button>
    </td>
</tr>