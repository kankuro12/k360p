@extends('layouts.adminlayouts.admin-design')
@section('content')
@php
    $option=\App\model\admin\DefaultShipping::first();
@endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">local_shipping</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Manage Store Shipping Detail</h4>
                        <div>
                            
                            <form method="POST">
                            
                                @csrf
                                <br>
                                <div style="padding:25px;">

                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="province_id">Select A province</label>
                                                <select class="form-control" data-live-search="true" id="province_id"
                                                    name="province_id" data-style="btn btn-primary "
                                                    title="Select a Province" data-size="7" required
                                                    style="border:1px solid #b6b6b6;">
                                                    <option></option>
                                                    @foreach (\App\Province::all() as $province)
                                                        <option value="{{ $province->id }}" >{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district_id">Select a District</label>

                                                <select class="form-control" data-live-search="true" id="district_id"
                                                    name="district_id" data-style="btn btn-primary "
                                                    title="Select a District" data-size="7" required
                                                    style="border:1px solid #b6b6b6;">
                                                    <option> </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="municipality_id"> Select a Munucipality</label>

                                                <select class="form-control" data-live-search="true" id="municipality_id"
                                                    name="municipality_id" data-style="btn btn-primary "
                                                    title="Select Province" data-size="7" required
                                                    style="border:1px solid #b6b6b6;">
                                                    <option> </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="municipality_id">Select a Shipping Zone</label>

                                                <select class="form-control" data-live-search="true" id="shipping_area_id"
                                                    name="shipping_area_id" data-style="btn btn-primary "
                                                    title="Select Province" data-size="7" required
                                                    style="border:1px solid #b6b6b6;">
                                                    <option></option>

                                                </select>
                                            </div>
                                        </div>
                                       
                                      
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4  text-center">
                                        <div class="form-group ">

                                            <input type="submit" class="btn btn-primary" value="Save Store Shipping Detail">
                                        </div>
                                    </div>
                                </div>
                               
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        district = {!!\App\ District::all()->toJson() !!}
        municipality = {!!\App\ Municipality::all()->toJson() !!}
        area = {!!\App\ ShippingArea::all()->toJson() !!}


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
        @if($option!=null)
        $( document ).ready(function() {
            $("#province_id").val({{$option->province_id}}).change();
            $("#district_id").val({{$option->district_id}}).change();
            $("#municipality_id").val({{$option->municipality_id}}).change();
            $("#shipping_area_id").val({{$option->shipping_area_id}}).change();
        });
        @endif


    </script>

@endsection
