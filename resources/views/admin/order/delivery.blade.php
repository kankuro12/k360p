@extends('layouts.adminlayouts.admin-design')
@section('content')
    <style>
        .mintable {
            width: 100%;
        }

        .mintable>tbody>tr>td {
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .mintable>tbody>tr>th {
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        #errmsg {
            color: red;
        }

    </style>
    <div class="container-fluid">
        <div class="col-sm-12 col-sm-offset-0">
            <!--      Wizard container        -->

            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">local_shipping</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">
                        Add A Trip
                    </h4>
                    <div class="toolbar">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <span class="input-group-text">
                                    Enter #Order Track ID (Press Enter To search Item)
                                </span>

                                <input type="text" class="form-control" placeholder="#Order Track ID" id="order">
                                <span id="errmsg"></span>
                            </div>
                        </div>

                    </div>
                    <br>

                    <form action="{{ route('admin.orders-ondelivery') }}" method="POST" id="trip">
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Delivery Reference Code</span>
                                    <input type="text" name="code" id="code" class="form-control" required
                                        placeholder="Please Enter A Reference Code For Delivery">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="selectpicker" data-live-search="true" id="point" name="pickup_point_id"
                                        data-style="btn btn-primary btn-round" title="Select a Pickup / Delivery Point"
                                        data-size="5" required>
                                        @foreach ($points as $point)
                                            <option value="{{ $point->id }}">{{ $point->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="padding:1rem" id="error">
                        </div>
                        @csrf
                        <div style="padding:1rem" id="datadd">
                        </div>
                    </form>
                    <div>
                        <button class="btn btn-primary" onclick="submit()"> Add New Trip</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wizard container -->
    </div>

@endsection
@section('scripts')
    <script>
        function loadimage(id) {
            elements = document.querySelectorAll(".sid-" + id);
            elements.forEach((element) => {
                element.src = element.dataset.src;
            });
        }

        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchinput");
            filter = input.value.toUpperCase();

            tr = document.querySelectorAll(".search");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                txtValue = tr[i].dataset.search;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // $("#e").on('keypress',function(e) {
        //     if(e.which == 13) {
        //         console.log(this);
        //         alert($('val'));
        //     }
        // });

        $("#order").keypress(function(e) {
            if (e.which == 13) {
                query($(this).val());
            } else {

                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            }
        });

        function query(id) {
            var statusurl = '/admin/orders/data/delivery/load';
            // console.log(status, formid, statusurl);
            
            $.post(statusurl, {
                'id': id
            }, function(data, stat, xhr) {
                if (stat == "success") {
                    if (document.querySelectorAll("#order-" + id).length == 0) {
                        $('#datadd').append(data);
                    }
                } 
                $("#order").val('');
                // console.log(data);
            });
        }



        function loadorderdata(id) {
            console.log('load order');
        }

        function loadordergroupdata(id) {
            console.log('loadordergroup');
        }

        function submit() {
            var isValid = $('#code').val() != "" && $('#point').val() != "" && $('.ids').length > 0;
            if (isValid) {
                $('#trip').submit();
            }

        }

    </script>
@endsection
