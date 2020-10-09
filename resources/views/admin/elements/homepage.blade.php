@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card" style="min-height: 200px;">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Homepage Section</h4>
                        <div>
                            <button class="btn btn-primary" onclick="showModal(0)">Add Root Section</button>
                        </div>
                        <div class="content-view">
                            <div id="root">
                                @foreach (\App\model\admin\HomePageSection::where('parent_id',0)->get() as $item )
                                <div id="s_{{$item->id}}">
                                    <div class="row" >
                                        <div class="col-md-4">
                                            @if ($item->type==0)
                                            <a href="#" data-toggle="collapse" data-target="#section{{$item->id}}" >
                                                <strong id="sec_{{$item->id}}_name">{{$item->name}}</strong>
                                            </a>
                                                @else
                                                <strong id="sec_{{$item->id}}_name">{{$item->name}}</strong>
                                            @endif
                                            ({{\App\Setting\HomePage::sectiontype[$item->type]}})
                                        </div>
                                        <div class="col-md-2">
                                            <strong >Rows : </strong>
                                            <span id="sec_{{$item->id}}_row">
                                                {{$item->row}}
                                            </span>
                                            
                                        </div>
                                        <div class="col-md-2">
                                            <strong>Order : </strong>
                                            <span id="sec_{{$item->id}}_order">
                                                {{$item->order}}
                                            </span>
                                        </div>
                                        <div class="col-md-4">
                                            @if ($item->type==0)
                                                <a href="#" onclick="showModal({{$item->id}})"  >Add New</a>
                                                @else
                                                <a href="{{route('elements.manage',['section'=>$item->id])}}" target="_blank">Manage</a>
                                                @endif
                                                | <a href="#" onclick="del({{$item->id}})"  >Del</a>
                                                | <a href="#"  onclick="edit({{ $item->id }})">Edit</a>

                                        </div>
                                    </div>
                                    <hr>
                                    @if ($item->type==0)
                                        <div class="collapse" style="padding-left:100px;" id="section{{$item->id}}">
                                            @if($item->childCount()>0)
                                                @foreach ($item->child() as $data)
                                                    @include('admin.elements.child',['data'=>$data])
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>

    
    <!--Add Tag  Modal -->
@include('admin.elements.section')
@endsection
<script id="semi" type="template">
    <div id="s_{id}">
        <div class="row" >
            <div class="col-md-4">
                
                <a href="#" data-toggle="collapse" data-target="#section{id}" >
                    <strong id="sec_{id}_name">{name}</strong>
                </a>
                ({w})
            </div>
            <div class="col-md-2">
                <strong>Rows : </strong>
                <span id="sec_{id}_row">
                    {row}
                </span>
                
            </div>
            <div class="col-md-2">
                <strong>Order : </strong>
                <span id="sec_{id}_order">
                    {order}
                </span>
            </div>
            <div class="col-md-4">
            <a href="#" onclick="showModal({id})"  >Add New</a>
            | <a href="#" onclick="del({id})">Del</a>
            | <a href="#" onclick="edit({id})">Edit</a>
            </div>
        </div>
        <hr>
        <div class="collapse" style="padding-left:100px;" id="section{id}">
            
        </div>
    </div>
</script>
<script id="full" type="template">
    <div id="s_{id}">
        <div class="row" >
            <div class="col-md-4">
                <strong id="sec_{id}_name">{name}</strong>
                ({w})
            </div>
            <div class="col-md-2">
                <strong>Rows : </strong>
                <span id="sec_{id}_row">
                    {row}
                </span>
                
            </div>
            <div class="col-md-2">
                <strong>Order : </strong>
                <span id="sec_{id}_order">
                    {order}
                </span>
            </div>
            <div class="col-md-4">
                <a href="{m}" target="_blank">Manage</a>
                | <a href="#" onclick="del({id})">Del</a>
                | <a href="#" onclick="edit({id})">Edit</a>
            </div>
        </div>
        <hr>
    </div>
</script>
@section('scripts')
<script>
    const addurl='{{route("elements.add")}}';
    const delurl='{{route("elements.del",['section'=>'_s_'])}}';
    const manageurl='{{route("elements.manage",['section'=>'_s_'])}}';
    const editurl='{{route("elements.edit")}}';
    const types=[
        @foreach (\App\Setting\HomePage::sectiontype as $key=>$item)
            '{{$item}}',
        @endforeach

    ];
</script>
<script src="{{asset('js/backend-js/elements/savesection.js')}}"></script>
    <script>
        function showModal(parent_id){
            $("#parent_id").val(parent_id);
            $('#addsection').modal('show')

        }

        function edit(id){
            $("#e_id").val(id);
            $("#e_name").val($('#sec_'+id+"_name").text());
            console.log(parseInt( $('#sec_'+id+"_row").text()));
            console.log($('#sec_'+id+"_order").text());
            $("#e_row").val(parseInt($('#sec_'+id+"_row").text()));
            $("#e_order").val(parseInt($('#sec_'+id+"_order").text()));
            $('#editsection').modal('show');  
        }
    </script>
@endsection
