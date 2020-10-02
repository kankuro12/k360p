@php
    $shipping=$data['shipping'];
@endphp
<tr>
    <td >{{$i}}</td>
    <td>
        {{$shipping->name}}
        <br>
        <strong style="color:#0acf21;">
            {{$shipping->created_at->diffForHumans()}}
        </strong>
    </td>
    <td>
        {{$shipping->area->name}},<br>  {{$shipping->municipality->name}},<br> {{$shipping->district->name}}, {{$shipping->province->name}}
    </td>
    <td>
        {{$shipping->email}}
    </td>
    <td>
        {{$shipping->phone}}
    </td>
    <td>
        {{$data['count']}}  Items
        <br>
    <a data-toggle="collapse" onclick="loadimage({{$shipping->id}});" href="#order-{{$shipping->id}}" aria-expanded="false" aria-controls="collapseExample">
            View Items
          </a>
    </td>
</tr>

<tr>
    <td colspan="6">
        <div class="collapse" id="order-{{$shipping->id}}">
            @foreach ($data['items'] as $order)
                <div >
                   @include('admin.order.singleorder',['order'=>$order,'sid'=>$shipping->id])
                </div>
             @endforeach
          </div>
    </td>
</tr>