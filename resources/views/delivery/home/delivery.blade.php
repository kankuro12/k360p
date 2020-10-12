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
                   
                    <br>
                    <div>
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
                    <form action="{{route('delivery.delivered-complete')}}" method="post" id="pickups" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <span class="input-group-text">
                                Enter #OTP for the order / OrderGroup
                            </span>
                            <input type="text" class="form-control" placeholder="#Order OTP" id="otp" name="otp">
                            <span id="errmsg"></span>
                        </div>
                        <div style="padding:1rem" id="data">
                        </div>

                        
                        <div id="imagesholder">
                            <span onclick="imageholder()" class="btn btn-sm btn-primary">Add Another images</span>
                            <input type="file" name="image[]" id="image" required="required" class="form-input" accept="image/*" placeholder="Add Verification Image" >
                        </div>
                        <div id="images">

                        </div>
                       
                        <div id="mark1">

                        </div>
                    </form>
                    <div id="mark0">
                        <button class="btn btn-primary" onclick="received()">Check Otp</button>
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
    

        $("#imagesholder").hide();
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
            var statusurl = '{{route('delivery.delivered-order')}}';
            // console.log(status, formid, statusurl);
          
            $.post(statusurl, {
                'id': id
            }, function(data, stat, xhr) {
                if (stat == "success") {
                    if($('#order-'+id).length==0){

                        $('#data').append(data);
                    }
                } else {
                    alert('data');
                }
                $("#order").val('');
                console.log(data);
            });
        }
        var taro=1;
        function imageholder(){
            taro+=1;
            html= '<div class="row" id="i-'+taro+'"><div class="col-md-9"><input type="file" name="image[]" id="image" required="required" class="form-input" accept="image/*"  placeholder="Add Verification Image"></div><div class="col-md-3"><span class="btn btn-sm btn-danger " style="margin:3px;" onclick="$(\'#i-'+taro+'\').remove()">Delete</span></div></div>';
            $('#images').append(html)
        }

        function received(){
            var otpurl='{{route('delivery.check-otp')}}';
            if($('.ids').length>0 && $('#otp').val()!=''){
                    $.post(otpurl, $("#pickups").serialize(), function(data, stat, xhr) {
                        $('#mark0').remove();
                        $('#mark1').html('<button class="btn btn-primary">Set Delivered</button>');
                        $("#imagesholder").show();

                    }).fail(function(jqXHR, textStatus, errorThrown){
                       alert(jqXHR.responseText);
                    });
            }else{
                alert("Please Add At least one item tolist");
            }
        }

    </script>
@endsection
