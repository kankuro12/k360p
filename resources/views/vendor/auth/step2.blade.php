@extends('vendor.step')
@section('content')
    <form method="POST">
        @csrf
        <br>
        <div style="padding:25px;">
            <div class="row">
                <div class="col-md-12  ">
                    <div class="form-group label-floating">
                        <input type="text" class="form-control" placeholder="Enter Store Name" name="storename"
                            id="storename" required>
                    </div>
                </div>
                <div class="col-md-12  ">
                    <div class="form-group label-floating">

                        <input type="text" class="form-control" placeholder="Landmark Near you " name="landmark"
                            id="landmark" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="province_id">Select A province</label>
                        <select class="form-control" data-live-search="true" id="province_id" name="province_id"
                            data-style="btn btn-primary " title="Select a Province" data-size="7" required  style="border:1px solid #b6b6b6;">
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

                    <select class="form-control" data-live-search="true" id="district_id" name="district_id"
                        data-style="btn btn-primary " title="Select a District" data-size="7" required style="border:1px solid #b6b6b6;">
                        <option> </option>

                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="municipality_id"> Select a Munucipality</label>

                    <select class="form-control" data-live-search="true" id="municipality_id" name="municipality_id"
                        data-style="btn btn-primary " title="Select Province" data-size="7" required style="border:1px solid #b6b6b6;">
                        <option> </option>

                    </select>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipality_id">Select a Shipping Zone</label>

                    <select class="form-control" data-live-search="true" id="shipping_area_id" name="shipping_area_id"
                        data-style="btn btn-primary " title="Select Province" data-size="7" required style="border:1px solid #b6b6b6;">
                        <option></option>

                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipality_id">Select a Your Shipping Range</label>

                    <select class="form-control" data-live-search="true" id="deliver_range"
                        name="deliver_range" data-style="btn btn-primary " title="Select Province" data-size="7"
                        required style="border:1px solid #b6b6b6;">
                        <option> </option>
                        <?php $i = 0; ?>
                        @foreach (\App\Setting\VendorOption::deliverrange as $item)
                            <option value="{{ $i }}">{{ $item }}</option>
                            <?php $i += 1; ?>
                        @endforeach

                    </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label >Street Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter Street Address" required>
                </div>
                <div class="col-md-3  ">
                    <div class="form-group label-floating">

                        <input type="checkbox" name="bulkbuy" id="bulkbuy" value="1"> Bulk Buy
                    </div>
                </div>
                <div class="col-md-3  ">
                    <div class="form-group label-floating">

                        <input type="checkbox" name="bulksell" id="bulksell" value="1"> Bulk Sell
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4  text-center">
                <div class="form-group ">

                    <input type="submit" class="btn btn-danger" value="Next">
                </div>
            </div>
        </div>
    </form>
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

    </script>

@endsection
