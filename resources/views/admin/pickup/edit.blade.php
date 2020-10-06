<form method="POST" action="{{route('admin.update-pickup',['point'=>$point->id])}}">
    @csrf
    <br>
    <div style="padding:25px;">

        <div class="row">

            <div class="col-md-12  ">
                <div class="form-group ">
                    {{-- <label for="name">Enter Pickup Point name</label>
                    --}}

                    <input type="text" class="form-control" placeholder="Enter PickupPoint Name" name="name" id="name"
                        required value="{{ $point->name }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="province_id">Select A province</label>
                    <select class="form-control" data-live-search="true" id="province_id" name="province_id"
                        data-style="btn btn-primary " title="Province" data-size="7" required
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
                    <label for="district_id">District</label>

                    <select class="form-control" data-live-search="true" id="district_id" name="district_id"
                        data-style="btn btn-primary " title="District" data-size="7" required
                        style="border:1px solid #b6b6b6;">
                        <option> </option>

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="municipality_id"> Munucipality</label>

                    <select class="form-control" data-live-search="true" id="municipality_id" name="municipality_id"
                        data-style="btn btn-primary " title="Select Province" data-size="7" required
                        style="border:1px solid #b6b6b6;">
                        <option> </option>

                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="municipality_id">Shipping Zone</label>

                    <select class="form-control" data-live-search="true" id="shipping_area_id" name="shipping_area_id"
                        data-style="btn btn-primary " title="Select Province" data-size="7" required
                        style="border:1px solid #b6b6b6;">
                        <option></option>

                    </select>
                </div>
            </div>
            
            <div class="col-md-12">
                    <label >Street Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter Street Address" required
                    value="{{ $point->street_address }}">
            </div>
            <div class="col-md-6  ">
                <div class="form-group ">
                    <label >Email</label>
                    <input class="form-control" type="email" name="email" id="email" required
                        placeholder="enter email address" required value="{{ $point->user->email }}">
                </div>
            </div>
            <div class="col-md-6  ">
                <div class="form-group ">
                    <label >phone</label>
                    <input class="form-control" type="text" minlength="10" maxlength="10" name="phone" id=""
                        placeholder="Enter Phone no" value="{{ $point->phone }}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">

            <div class="form-group ">

                <input type="submit" class="btn btn-primary" value="Update Shipping Point">
            </div>
        </div>
    </div>
</form>
