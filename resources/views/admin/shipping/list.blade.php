@extends('layouts.adminlayouts.admin-design')
@section('content')
<style>
    .in-hidden{
        width:100% !important;
        border: none;
        background: transparent;
        text-align: center;
    }
    .in-hidden:focus{
        border:3px solid #9C27B0;
    }
</style>
<br>
<div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
<br>
    <div class="container-fluid">
     
        <div class="row">
            <div class="col-md-12">
                <button id="create_modal" class="create_modal btn btn-fill btn-primary" >Add Shipping Class</button>
                <a href="{{route('admin.shipping-zones')}}" class="btn btn-primary">Manage Shipping Zones</a>
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                        <span>
                            <b> Success - </b>{!! session('flash_message') !!}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Shipping</h4>
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="content-view">
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Weight Class</th>
                                            <th class="text-center">Dimension Class</th>
                                         
                                            <th colspan="3" class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippings as $shipping)
                                            <tr>
                                                <form action="{{route('admin.shipping-update',['shipping'=>$shipping->id])}}" method="post">
                                                @csrf
                                                <td class="text-center">
                                                    <input value="{{ $shipping->name }}" type="text" name="name" class="in-hidden">
                                                
                                                    
                                                </td>
                                                <td class="text-center">
                                                   <input value="{{ $shipping->weightclass }}" type="text" name="weightclass" class="in-hidden">
                                                    
                                                </td>
                                                <td class="text-center">
                                                   <input value="{{ $shipping->dimensionclass }}" type="text" name="dimensionclass" class="in-hidden">

                                                  
                                                </td>
                                                <td>
                                                    <button data-toggle="tooltip" data-placement="left" title="Update"
                                                        class="btn  btn-just-icon btn-round btn-primary"><i
                                                            class="material-icons">save
                                                        </i></button>
                                                </td>    
                                            </form>
                                            
                                            <td class="text-center"> 
                                            <form action="{{route('admin.shipping-status',['shipping'=>$shipping->id,'status'=>$shipping->enabled==1?0:1])}}" method="post">
                                            @csrf
                                            <button data-toggle="tooltip" data-placement="left" title="{{$shipping->enabled==0?"Enable":"Disable"}}" class="btn   btn-primary">
                                                
                                                    {{$shipping->enabled==0?"Enable":"Disable"}}
                                               
                                            </button>
                                            </form>
                                            </td>
                                                <td class="text-center">

                                                <a href="/admin/shippings/manage/{{$shipping->id}}" data-toggle="tooltip" data-placement="left" title="Manage {{$shipping->name}}"
                                                        class="btn  btn-just-icon btn-round btn-secondary"><i
                                                            class="material-icons">view_list</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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



    <!-- Modal -->
    <div class="modal fade"  id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Shipping </h5>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{route('admin.shipping-add')}}"  enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 pr-md-1">
                                <div class="form-group label-floating">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-md-6 pr-md-1">
                                <div class="form-group label-floating">
                                    <label class="control-label">Weigh class (eg. kg)</label>
                                    <input type="text" class="form-control" name="weightclass" id="weightclass">
                                </div>
                            </div>
                            <div class="col-md-6 pr-md-1">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dimension class (eg. cm)</label>
                                    <input type="text" class="form-control" name="dimensionclass" id="name">
                                </div>
                            </div>
                        </div>
                       
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-outline btn-danger" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-outline btn-primary" id="add"  value="save">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Modal -->
@endsection
@section('scripts')
    <script >

        @if(Session::has( 'success' ))
         $.notify({
            icon: "notifications",
            message: "{{Session::get( 'success' )}}"

        }, {
            type: type[color],
            delay: 2000,
            timer: 200,
            placement: {
                from: from,
                align: align
            }
        });
        @endif
        $('#create_modal').click(function(){
                $('#create').modal('show');
        });
    </script>
@endsection
