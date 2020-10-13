@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div style="padding:50px;">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">map</i>
            </div>
            <div class="card-content">
                <h3 class="card-title">
                    <strong>
                        <a href="{{ route('admin.shippings') }}">Shippings</a> 
                    </strong>
                    /
                    Shipping Zones
                </h3>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="content-view">
                    @foreach ($provinces as $province)
                        <button class="btn  text-left" type="button" data-toggle="collapse"
                            data-target="#province_{{ $province->id }}" aria-expanded="false"
                            aria-controls="collapseExample" style="width:100%;text-align:left;margin:5px 0 0 0 ;">
                            {{ $province->name }}
                        </button>
                        <div class="collapse" style="padding-left:40px;" id="province_{{ $province->id }}">
                            @foreach ($province->districts as $district)
                                <button class="btn  text-left" type="button" data-toggle="collapse"
                                    data-target="#district_{{ $district->id }}" aria-expanded="false"
                                    aria-controls="collapseExample" style="width:100%;text-align:left;margin:5px 0 0 0 ;">
                                    {{ $district->name }}
                                </button>
                                <div class="collapse" style="padding-left:40px;" id="district_{{ $district->id }}">
                                    @foreach ($district->municipalities as $municipality)
                                        <button class="btn text-left" type="button" data-toggle="collapse"
                                            data-target="#municipality_{{ $municipality->id }}" aria-expanded="false"
                                            aria-controls="collapseExample"
                                            style="width:100%;text-align:left;margin:5px 0 0 0 ;">
                                            {{ $municipality->name }}
                                        </button>
                                        <div class="collapse" style="padding-left:40px;"
                                            id="municipality_{{ $municipality->id }}">
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input class="form-control"
                                                            placeholder="Enter New Shipping Zone Name"
                                                            id="mun_{{ $municipality->id }}_input">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button onclick="addarea({{ $municipality->id }})"
                                                            class="btn btn-primary">Add
                                                            New Zone</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <ul id="mun_{{ $municipality->id }}_items">
                                                    @foreach ($municipality->areas as $area)
                                                        <li id="mun_item_{{ $area->id }}">
                                                            <div class="row">
                                                                <div class="col-md-7">

                                                                    <input class="form-control" type="text"
                                                                        value="{{ $area->name }}"
                                                                        id="mun_item_{{ $area->id }}_input">
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <br>
                                                                    <span>
                                                                        <span class=" btn-link"
                                                                            onclick="updatearea({{ $area->id }})"
                                                                            style="color:red;">Update
                                                                        </span>
                                                                    </span>
                                                                    <span>
                                                                        <span class=" btn-link"
                                                                            onclick="delarea({{ $area->id }})"
                                                                            style="color:red;">Delete
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>



@endsection

@section('scripts')
    <script>
        function addarea(mun_id) {
            name = $('#mun_' + mun_id + '_input').val();
            if (name == "") {
                alert('Enter Shipping area Name');
            }
            data = {
                'mun_id': mun_id,
                'name': name
            };
            $.ajax({
                type: 'POST',
                url: '/admin/shipping-zones-add',
                data: data,
                success: function(data) {
                    if (data.success) {
                        $('#mun_' + mun_id + '_items').append('<li id="mun_item_' + data.area.id +
                            '"> <div class="row"> <div class="col-md-7"><input class="form-control" type="text" value="' +
                            data.area.name + '" id="mun_item_' + data.area.id +
                            '_input"></div><div class="col-md-5"><br> <span><span class=" btn-link" onclick="updatearea(' +
                            data.area.id +
                            ')" style="color:red;">Update </span> </span> <span> <span class=" btn-link" onclick="delarea(' +
                            data.area.id + ')" style="color:red;">Delete</span> </span></div></div> </li>');
                        $('#mun_' + mun_id + '_input').val('');
                    }
                },
            });
        }

        function delarea(id) {
            data = {
                'id': id
            };
            $.ajax({
                type: 'POST',
                url: '/admin/shipping-zones-del',
                data: data,
                success: function(data) {
                    if (data.success) {
                        $('#mun_item_' + id).remove();
                    }
                },
            });
        }

        function updatearea(id) {
            name = $('#mun_item_' + id + '_input').val();
            if (name == "") {
                alert('Enter Shipping area Name');
            }
            data = {
                'id': id,
                'name': name
            };
            $.ajax({
                type: 'POST',
                url: '/admin/shipping-zones-update',
                data: data,
                success: function(data) {
                    if (data.success) {

                    }
                },
            });
        }

    </script>
@endsection
