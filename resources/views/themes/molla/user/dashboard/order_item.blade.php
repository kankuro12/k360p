@extends('themes.molla.layouts.app')
@section('title','User Orders')
@section('contant')
<main class="main">
    <div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Orders<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{ url('/user/dashboard') }}"> My Account </a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>

            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('themes.molla.user.dashboard.header')

                    <div class="col-md-8 col-lg-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="accordion accordion-icon" id="accordion-4">
                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-1">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#collapse4-1" aria-expanded="true" aria-controls="collapse4-1">
                                                    <i class="icon-star-o"></i>Pending
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-1" class="collapse show" aria-labelledby="heading4-1" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-2">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse4-2" aria-expanded="false" aria-controls="collapse4-2">
                                                    <i class="icon-star-o"></i>Accepted
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-2" class="collapse" aria-labelledby="heading4-2" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-3">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse4-3" aria-expanded="false" aria-controls="collapse4-3">
                                                    <i class="icon-star-o"></i>On Delivery
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-3" class="collapse" aria-labelledby="heading4-3" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-4">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse4-4" aria-expanded="false" aria-controls="collapse4-4">
                                                    <i class="icon-star-o"></i>Pickup
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-4" class="collapse" aria-labelledby="heading4-4" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-5">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse4-5" aria-expanded="false" aria-controls="collapse4-5">
                                                    <i class="icon-star-o"></i>Delivered
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-5" class="collapse" aria-labelledby="heading4-5" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-6">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse4-6" aria-expanded="false" aria-controls="collapse4-6">
                                                    <i class="icon-star-o"></i>Rejected
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-6" class="collapse" aria-labelledby="heading4-6" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box bg-light">
                                        <div class="card-header" id="heading4-7">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse4-7" aria-expanded="false" aria-controls="collapse4-7">
                                                    <i class="icon-star-o"></i>Returned
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse4-7" class="collapse" aria-labelledby="heading4-7" data-parent="#accordion-4">
                                            <div class="card-body">
                                                <table class="table table-cart table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Traking Id</th>
                                                            <th>Product</th>
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
                                                            <td class="product-col">
                                                                <div class="product" style="background: none;">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="{{asset($order->product->product_images) }}" alt="Product image">
                                                                        </a>
                                                                    </figure>
                                                                </div><!-- End .product -->
                                                            </td>

                                                            <td>{{$order->qty}}</td>
                                                            <td>{{$order->rate}}</td>

                                                            <td><a href="{{route('user.order.item',$order->id)}}">View Details</a></td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->


                                </div><!-- End .accordion -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection