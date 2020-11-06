@extends('themes.molla.user.dashboard.app')
@section('title','User Orders')
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Orders</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.account') }}"><i class="zmdi zmdi-home"></i> User Dashboard </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card mt-2">
                        <div class="body">
                            <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingOne_1">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1" class="collapsed"><i class="zmdi zmdi-hc-fw"></i> Pending </a> </h4>
                                    </div>
                                    <div id="collapseOne_1" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne_1" style="">
                                        <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 0)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingThree_1">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false" aria-controls="collapseThree_1"><i class="zmdi zmdi-hc-fw"></i> Accepted </a> </h4>
                                    </div>
                                    <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" style="">
                                    <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 1)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingFour_1">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFour_1" aria-expanded="false" aria-controls="collapseFour_1"><i class="zmdi zmdi-hc-fw"></i> On Delivery </a> </h4>
                                    </div>
                                    <div id="collapseFour_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_1" style="">
                                    <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 2)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingFive_1">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFive_1" aria-expanded="false" aria-controls="collapseFive_1"><i class="zmdi zmdi-hc-fw"></i> Pickup </a> </h4>
                                    </div>
                                    <div id="collapseFive_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive_1" style="">
                                    <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 3)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingSix_1">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseSix_1" aria-expanded="false" aria-controls="collapseSix_1"><i class="zmdi zmdi-hc-fw"></i> Delivered </a> </h4>
                                    </div>
                                    <div id="collapseSix_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix_1" style="">
                                    <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 4)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingSev_1">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseSev_1" aria-expanded="false" aria-controls="collapseSev_1"><i class="zmdi zmdi-hc-fw"></i> Rejected </a> </h4>
                                    </div>
                                    <div id="collapseSev_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSev_1" style="">
                                    <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 5)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="headingTwo_1">
                                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false" aria-controls="collapseTwo_1"><i class="zmdi zmdi-hc-fw"></i> Returned </a> </h4>
                                    </div>
                                    <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1" style="">
                                    <div class="panel-body p-0">
                                            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                                <div class="card project_list">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover c_table theme-color pt-2">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 50px;">Traking Id</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($orderItems as $items)
                                                                @foreach($items as $order)
                                                                @if($order->stage == 6)
                                                                <tr>
                                                                    <td>#{{ $order->id }}</td>
                                                                    <td>
                                                                        <img class="rounded avatar" src="{{asset($order->product->product_images) }}" alt="Product Image">
                                                                    </td>
                                                                    <td>{{ $order->product->product_name }}</td>
                                                                    <td>{{$order->qty}}</td>
                                                                    <td>{{$order->rate}}</td>
                                                                    <td>
                                                                        <a href="{{route('user.order.item',$order->id)}}">View Details</a> <br>
                                                                        <a href="{{route('user.full.order',$order->shipping_detail_id)}}">View Full Order</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection