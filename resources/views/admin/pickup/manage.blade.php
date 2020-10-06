@extends('layouts.adminlayouts.admin-design')
@section('content')
@php
    $sel=1;
    if(session('sel')){
        $sel=session('sel');
    }
@endphp
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif
        @if (Session::has('msg'))
            <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            
                            <a href="{{route('admin.pickup')}}"> <strong>Pickup Points</strong></a> /
                            {{$point->name}}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-2">
                                <ul class="nav nav-pills nav-pills-icons nav-pills-rose nav-stacked" role="tablist">
                                    <li class="{{$sel==1?"active":""}}">
                                        <a href="#detail" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="material-icons">info</i> General Info
                                        </a>
                                    </li>
                                    <li class="{{$sel==2?"active":""}}">
                                        <a href="#un" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">photo_library</i> Undelivered
                                        </a>
                                    </li>
                                    <li class="{{$sel==3?"active":""}}">
                                        <a href="#delivered" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">notes</i> Delivered
                                        </a>
                                    </li>
                                    <li class="{{$sel==4?"active":""}}">
                                        <a href="#payments" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="material-icons">local_shipping</i> Payments
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <div class="tab-content">
                                    
                                    <div class="tab-pane {{$sel==1?"active":""}}" id="detail" >
                                        @include('admin.pickup.edit')
                                    </div>
                                    <div class="tab-pane {{$sel==2?"active":""}}" id="un" >
                                        @include('admin.pickup.orders',['point'=>$point,'status'=>3])
                                        
                                    </div>
                                    <div class="tab-pane {{$sel==3?"active":""}}" id="delivered" >
                                        @include('admin.pickup.orders',['point'=>$point,'status'=>4])
                                        
                                        
                                    </div>
                                    <div class="tab-pane {{$sel==4?"active":""}}" id="payments" >
                                       
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
@section('scripts')
    <script>
       district = {!!\App\ District::all()->toJson() !!};
        municipality = {!!\App\ Municipality::all()->toJson() !!};
        area = {!!\App\ ShippingArea::all()->toJson() !!};


        $('#province_id').change(function() {
            province_id = $('#province_id').val();

            str = "<option> </option>";
            district.forEach(element => {

                if (element.province_id == province_id) {

                    str += "<option value='" + element.id + "'>" + element.name + "</option>";
                }
            });
            $('#district_id').html(str);
            $('#municipality_id').html("<option> </option>");
            $('#shipping_area_id').html("<option> </option>");

        });
        $('#district_id').change(function() {
            district_id = $('#district_id').val();

            str = "<option></option>";
            municipality.forEach(element => {

                if (element.district_id == district_id) {

                    str += "<option value='" + element.id + "'>" + element.name + "</option>";
                }
            });

            $('#municipality_id').html(str);
            $('#shipping_area_id').html("<option> </option>");

        });
        $('#municipality_id').change(function() {
            municipality_id = $('#municipality_id').val();

            str = "<option> </option>";
            area.forEach(element => {

                if (element.municipality_id == municipality_id) {

                    str += "<option value='" + element.id + "'>" + element.name + "</option>";
                }
            });


            $('#shipping_area_id').html(str);

        });

        $( document ).ready(function() {
            $("#province_id").val({{$point->province_id}}).change();
            $("#district_id").val({{$point->district_id}}).change();
            $("#municipality_id").val({{$point->municipality_id}}).change();
            $("#shipping_area_id").val({{$point->shipping_area_id}}).change();
        });

    </script>

@endsection