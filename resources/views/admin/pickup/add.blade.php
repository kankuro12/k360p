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
                        <h4 class="card-title"> <a href="{{route('admin.pickup')}}"> <strong>Pickup Points</strong></a> / Add New </h4>
                        
                        <div class="content-view">
                            <form method="POST">
                                @csrf
                                <br>
                                <div style="padding:25px;">

                                    <div class="row">

                                        <div class="col-md-12  ">
                                            <div class="form-group ">
                                                {{-- <label for="name">Enter Pickup Point name</label> --}}

                                                <input type="text" class="form-control" placeholder="Enter PickupPoint Name"
                                                    name="name" id="name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="province_id">Select A province</label>
                                                <select class="form-control" data-live-search="true" id="province_id"
                                                    name="province_id" data-style="btn btn-primary "
                                                    title="Select a Province" data-size="7" required
                                                    style="border:1px solid #b6b6b6;">
                                                    <option></option>
                                                    @foreach (\App\Province::all() as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
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
                                        <div class="col-md-12">
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
                                       
                                        <div class="col-md-12">
                                          
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Enter Street Address" required>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="form-group label-floating">
                                                
                                               <input class="form-control" type="email" name="email" id="email" required placeholder="enter email address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="form-group label-floating">

                                                <input class="form-control" type="text" minlength="10" maxlength="10" name="phone" id="" placeholder="Enter Phone no">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                    
                                        <div class="form-group ">

                                            <input type="submit" class="btn btn-primary" value="Add Shipping Point">
                                        </div>
                                    </div>
                                </div>
                            </form>
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

    </script>

@endsection
