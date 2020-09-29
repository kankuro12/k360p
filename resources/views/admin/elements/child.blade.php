<div id="s_{{ $data->id }}">
   
    <div class="row">
        <div class="col-md-4">
            @if ($data->type == 0)
                <a href="#" data-toggle="collapse" data-target="#section{{ $data->id }}">
                    <strong id="sec_{{$data->id}}_name"> {{ $data->name }}</strong>
                </a>
            @else
                <strong id="sec_{{$data->id}}_name">{{ $data->name }}</strong>
            @endif
            ({{ \App\Setting\Homepage::sectiontype[$item->type] }})
        </div>
        <div class="col-md-2">
            <strong>Rows : </strong> 
            <span id="sec_{{$data->id}}_row">
                {{$data->row}}
            </span>

        </div>
        <div class="col-md-2">
            <strong>Order : </strong>
            <span id="sec_{{$data->id}}_order">
                {{$data->order}}
            </span>
        </div>
        <div class="col-md-4">
            @if ($data->type == 0)
                <a href="#" onclick="showModal({{ $data->id }})">Add New</a>
            @else
                <a href="{{route('elements.manage',['section'=>$data->id])}}" target="_blank">Manage</a>
            @endif
            | <a href="#"  onclick="del({{ $data->id }})">Del</a>
            | <a href="#"  onclick="edit({{ $data->id }})">Edit</a>
        </div>
    </div>

    <hr>

    @if ($data->type == 0)
        <div class="collapse" style="padding-left:100px;" id="section{{ $data->id }}">
            @if ($data->childCount() > 0)
                @foreach ($data->child() as $pdata)
                    @include('admin.elements.child',['data'=>$pdata])
                @endforeach
            @endif
        </div>
    @endif
</div>
