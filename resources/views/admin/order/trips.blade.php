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
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Trips</h4>
                    <div class="toolbar">
                        <a href="{{route('admin.orders-delivery')}}" class="btn btn-primary">Add Trip</a>
                    </div>
                    <div class="content-view">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-left" >Name</th>
                                    <th class="text-left">Pickup point</th>
                                    <th class="text-left">Date</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($all as $trip)
                                <tr>
                                    <td class="text-left"> 
                                        <strong>

                                            <a href="{{route('admin.orders-trip',['id'=>$trip->id])}}">
                                                {{ $trip->code }}
                                            </a>
                                        </strong>
                                    </td>
                                    <td class="text-left">{{ $trip->name }}</td>
                                    <td class="text-left">{{$trip->created_at}}</td>
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

@endsection
