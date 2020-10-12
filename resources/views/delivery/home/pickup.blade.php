@extends('delivery.layout.app')
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
                        Vendor Item Pickup

                    </h4>
                    <div class="toolbar">
                        <a href="{{ route('delivery.warehouse') }}{{ route('delivery.warehouse') }}" class="btn btn-primary">Item In WareHouse</a>
                    </div>
                   
                    <br>
                    <div>
                        <div>
                            <input type="date" id="date" class="form-control">
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
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <span class="input-group-text">
                                        Enter #Order Group/Shipping Track ID (Press Enter To Search Item)
                                    </span>
                                    <input type="text" class="form-control" placeholder="#Order Group/Shipping Track ID"
                                        id="ordergroup">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <form action="{{route('delivery.set-pickup')}}" method="post" id="pickups">
                        @csrf
                        <div style="padding:1rem" id="data">
                        </div>
                    </form>
                    <div >
                        <button class="btn btn-primary" onclick="received()">Mark Received</button>
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
        document.getElementById('date').valueAsDate = new Date();

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
            var statusurl = '{{route('delivery.order')}}';
            // console.log(status, formid, statusurl);
          
            $.post(statusurl, {
                'id': id
            }, function(data, stat, xhr) {
                if (stat == "success") {
                    $('#data').append(data);
                } else {
                    alert('data');
                }
                $("#order").val('');
                console.log(data);
            });
        }

        function pickup(id) {
            var statusurl = '{{route('delivery.order')}}';

            $.post(statusurl, {
                'id': id
            }, function(data, stat, xhr) {
                console.log(data, stat);
                if (stat == "success") {
                   if(data.pickedup===1){
                       $("#data").html('');
                   }

                } else {

                }
                console.log(data);
            });
        }

        function loadorderdata(id) {
            console.log('load order');
        }

        function loadordergroupdata(id) {
            console.log('loadordergroup');
        }

        function received(){
            if($('.ids').length>0){
                $('#pickups').submit();
            }else{
                alert("Please Add At least one item tolist");
            }
        }

    </script>
@endsection
