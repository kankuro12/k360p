@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('msg'))
                    <div class="alert alert-success">{{ Session::get('msg') }}</div>
                @endif

                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Pickup Point</h4>
                        <div class="toolbar">
                            <a href="{{ route('admin.add-pickup')}}" class="create_modal btn btn-fill btn-primary">Add
                                Pickup Points</a>
                        </div>
                        <div class="content-view">
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">

                                    <thead>
                                        <tr>
                                            <th class="text-left">Name</th>

                                            <th class="text-left">Email</th>
                                            <th class="text-left">Delivery Address</th>
                                            
                                            <th class="text-left">Street Address</th>
                                            
                                            <th class="text-left">Phone</th>
                                            <th class="disabled-sorting text-left">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($pickuppoints as $point)
                                            <tr>
                                                <td>
                                                    {{$point->name}}
                                                </td>
                                                <td>
                                                    {{$point->user->email}}
                                                </td>
                                                <td>
                                                    {{$point->area->name}},<br>  {{$point->municipality->name}},<br> {{$point->district->name}}, {{$point->province->name}}
                                                </td>
                                                <td>
                                                    {{$point->street_address}}
                                                </td>
                                                <td>
                                                    {{$point->phone}}
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.manage-pickup',['point'=>$point->id])}}">Manage</a>
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
@endsection
