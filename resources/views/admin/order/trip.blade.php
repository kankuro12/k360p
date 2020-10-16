@extends('layouts.adminlayouts.admin-design')
@section('content')

<div class="container-fluid">
<div class="row">
        <div class="col-md-12">
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
                </button>
                <span>
                <b> Success - </b>{!! session('flash_message') !!}</span>
            </div>
            @endif
            <form action="{{route('admin.orders-multiplePrint')}}" method="post" target="_blank" id="order">
                @csrf
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">
                        <a href="{{route('admin.orders-trips')}}">
                            Trips
                        </a>/ {{$trip->code}}  - ({{$trip->name}})</h4>
                    {{-- <div class="toolbar">
                        <a href="{{route('admin.orders-delivery')}}" class="btn btn-primary">Add Trip</a>
                    </div> --}}
                    <div class="content-view">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-left" >Shippping ID</th>
                                    <th class="text-left">Orders</th>
                                    <td></td>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($all as $data)
                                <tr>
                                    <td class="text-left"> 
                                        <strong>
                                          <input type="checkbox" name="ids[]" value="{{$data['shipping']->id}}">   #{{$data['shipping']->id}}
                                        </strong>
                                    </td>
                                    <td class="text-left">
                                        {{implode(',',$data['orders'])}}
                                    </td>
                                   
                                    <td>
                                        <strong>
                                            <a href="{{route('admin.orders-singlePrint',['shipping'=>$data['shipping']->id])}}" target="_blank">
                                                Print
                                            </a>
                                        </strong>
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

        </form>
        
        <div class="card" style="padding:1rem;">
            <div>
                <a href="{{route('admin.orders-tripPrint',['id'=>$trip->id])}}" class="btn btn-primary" target="_blank">Print all</a>
                <button type="submit" class="btn btn-primary" onclick="p()">Print Selected</button>
            </div>
        </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>

@endsection
@section('scripts')
    <script>
        function p(){
         if(document.querySelectorAll('input[type="checkbox"]:checked').length>0){
             console.log(document.getElementById("order"));
             document.getElementById("order").submit()
         }else{
             alert('please Select At least one  order');
         }

        }
    </script>
@endsection