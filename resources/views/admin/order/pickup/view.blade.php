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
                    <h4 class="card-title"> <a href="{{route('admin.orders-pickup')}}"> <strong>Vendor Item Pickup</strong> </a> / Items In WareHouse </h4>
                        @if (count($orders) > 0)

                            <hr>
                            <h3 style="padding-left: 1rem;"></h3>
                            <hr>
                            <div style="margin: 1.5rem 1rem;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <strong>

                                                Product Search
                                            </strong>
                                            <br>
                                        </label>
                                        <input type="text" id="searchinput" class="form-control" onkeyup="myFunction()"
                                            placeholder="Search using Product">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div id="list">

                            @foreach ($orders as $data)

                                <div style="margin:0.5rem;padding:1rem;" data-search="{{ $data['search'] }}"
                                    data-ids="[{{ $data['ids'] }}]" class="search">

                                    @php
                                    $shipping=$data['shipping'];
                                    @endphp

                                    <div class="modal-content" style="box-shadow:0px -2px 9px #0000005c;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#c-{{ $shipping->id }}" style="color:black;font-size: 21px;"
                                                onclick="loadimage({{ $shipping->id }})">=</button>
                                            <p class="modal-title">
                                                <strong>Shipping Group - #{{ $shipping->id }}</strong>, 
                                                <span> <strong>Products: </strong> {{$data['search']}}</span>,
                                                <span><strong>Order Tracking Ids: </strong> {{$data['ids']}}</span>
                                            </p>
                                            <hr style="margin: 0;">
                                            <div class="table-responsive">
                                                <table class="mintable">
                                                    <tr>
                                                        <td>
                                                            {{ $shipping->name }}
                                                            <br>
                                                            <strong style="color:#0acf21;">
                                                                {{ $shipping->created_at->diffForHumans() }}
                                                            </strong>
                                                        </td>
                                                        <td>
                                                            {{ $shipping->area->name }},<br>
                                                            {{ $shipping->municipality->name }},<br>
                                                            {{ $shipping->district->name }}, {{ $shipping->province->name }}
                                                        </td>
                                                        <td>
                                                            {{ $shipping->email }}
                                                        </td>
                                                        <td>
                                                            {{ $shipping->phone }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="collapse" id="c-{{ $shipping->id }}">
                                            <div id="items-{{ $shipping->id }}">
                                                @foreach ($data['items'] as $order)
                                                    @include('admin.order.pickup.singleorder',['order'=>$order,'sid'=>$shipping->id])
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

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

      
    </script>
@endsection
