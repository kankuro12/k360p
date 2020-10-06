@php
    $shipping=$data['shipping'];
@endphp
<tr data-search="{{$data['search']}}" class="search" id="orders-row-{{$shipping->id}}">
    <td >
        <a data-toggle="modal" onclick="loadimage({{$shipping->id}});" href="#order-modal-{{$shipping->id}}" aria-expanded="false" aria-controls="collapseExample">
            <strong>
                #{{$shipping->id}}
            </strong> 
        </a>
    </td>
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
        <a data-toggle="modal" onclick="loadimage({{$shipping->id}});" href="#order-modal-{{$shipping->id}}" aria-expanded="false" aria-controls="collapseExample">
            <div style="border-bottom: 1px #f1f1f1 solid;">
                {{$data['count']}}  Item{{$data['count']>1?"s":""}}
            </div>
            
            <div style="border-bottom: 1px #f1f1f1 solid;max-width:200px;">
                
                <strong style="color:#0acf21;">{{$data['search']}}</strong>
            </div>
            <div>
                View Items
            </div>
                
        </a>
    </td>
</tr>

{{-- @foreach ($data['items'] as $order)
<tr data-search="{{$data['search']}}" class="search">
    <td colspan="6">
        <div class="collapse" id="order-{{$shipping->id}}">
                <div >
                   @include('admin.order.singleorder',['order'=>$order,'sid'=>$shipping->id])
                </div>
            </div>
        </td>
    </tr>
@endforeach --}}