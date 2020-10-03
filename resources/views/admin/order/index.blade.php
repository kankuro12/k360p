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
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="order-modal-{{$shipping->id}}" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                @foreach ($data['items'] as $order)
                        <div >
                        @include('admin.order.singleorder',['order'=>$order,'sid'=>$shipping->id])
                        </div>
                @endforeach

                <div>
                    <form id="orders-form-{{$shipping->id}}" action="" style="display:inline;">
                        @csrf
                        <input type="hidden" name="sid" value="{{$shipping->id}}">
                        <input type="hidden" name="current" value="{{$status}}">

                        @foreach ($data['items'] as $order)
                            <input type="hidden" name="id[]" id="order-input-{{$order->id}}" value="{{$order->id}}">
                        @endforeach
                    </form>
                </div>
                <div style="margin: 5px 10px;">
                    @if ($status==0)
                        <span class="btn btn-success" onclick="acceptall({{$shipping->id}})">Accept All</span>
                        <span class="btn btn-danger" onclick="rejectall({{$shipping->id}})">Reject All</span>
                    @elseif($status==1)
                        <span class="btn btn-success" onclick="deliveryall({{$shipping->id}})">Send All To delivery</span>
                    @elseif($status==2)
                        <span class="btn btn-success" onclick="pickupall({{$shipping->id}})">Mark All as pickup</span>
                    @elseif($status==3)
                        <span class="btn btn-success" onclick="deliveredall({{$shipping->id}})">Mark All as Delivered</span>
                    @elseif($status==4)
                        <span class="btn btn-success" onclick="returnedall({{$shipping->id}})">Mark All as Returned</span>
                    @endif
                </div>
              </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
<script>
    var stage={{$status}};
    var o="order-";
    var r="orders-row-"
    var os="orders-";
    var osf="orders-form-";
    var of="order-form-";
    var om="order-modal-";
    var oi="order-input-";
    var url="{{route('admin.set-status',['status'=>'_s_'])}}";
</script>
<script src="{{asset('js\backend-js\order.js')}}"></script>
@endsection
