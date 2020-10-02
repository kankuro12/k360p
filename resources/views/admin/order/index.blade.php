@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 vendordetails">
                <h3 class="text-center" style="margin-top: 0px;">Store Order</h3>
                <br>
                <div class="nav-center">
                    <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                        @php
                        $i=0;
                        @endphp
                        @foreach ($stages as $stage)

                            <li class="{{ $i == $status ? 'active' : '' }}">
                                <a href="{{ route('admin.orders', ['status' => $i]) }}" aria-expanded="true">
                                    <i class="material-icons">{{ App\Setting\OrderManager::stageicons[$i] }}</i>{{ $stage }}
                                </a>
                            </li>
                            @php
                            $i+=1;
                            @endphp
                        @endforeach

                    </ul>
                </div>
                <div class="">
                    <div id="orders">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <strong>
                                        {{ App\Setting\OrderManager::stages[$status] }} Orders
                                    </strong>
                                </h4>

                            </div>
                            <div class="card-content">
                                <div class="content-view">

                                    <div style="margin: 1.5rem 0rem;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label >
                                                    <strong>

                                                        Product Search
                                                    </strong>
                                                    <br>
                                                </label>
                                                <input type="text"  id="searchinput" class="form-control" onkeyup="myFunction()" placeholder="Search using Product">
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        #ordertable > tbody > tr>td{
                                            padding: 10px 0;
                                            border-bottom: 1px solid #f1f1f1;
                                        }
                                        #ordertable > tbody > tr>th{
                                            padding: 10px 0;
                                            border-bottom: 1px solid #f1f1f1;
                                        }
                                    </style>
                                    <div class="table-responsive">

                                        <table  id="ordertable" style="width: 100%;">
                                            <tr>
                                                <th>SID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                            @php
                                            $i=1;
                                            @endphp
                                            @foreach ($all as $data)
                                                @include('admin.order.ordergroup',['data'=>$data,'i'=>$i])
                                                @php
                                                $i+=1;
                                                @endphp
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- Edit Attribute Modal -->


    @foreach ($all as $data)
    
        @php
            $shipping=$data['shipping'];
        @endphp
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="order-{{$shipping->id}}" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                @foreach ($data['items'] as $order)
                        <div >
                        @include('admin.order.singleorder',['order'=>$order,'sid'=>$shipping->id])
                        </div>
                @endforeach
              </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script>
        function loadimage(id){
            elements=document.querySelectorAll('.sid-'+id);
            elements.forEach(element => {
                element.src=element.dataset.src;
            });
        }
    
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("searchinput");
          filter = input.value.toUpperCase();
          table = document.getElementById("ordertable");
          tr = table.querySelectorAll('.search');
            
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
        </script>
@endsection
