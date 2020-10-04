@extends('layouts.adminlayouts.admin-design')
@section('content')
<div class="container-fluid">
    <div class="row">    
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="rose">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Brands</p>
                    <h3 class="card-title">{{ $brandno }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> All Brands
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Categories</p>
                    <h3 class="card-title">{{ $categoryno }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> All Categories
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Products</p>
                    <h3 class="card-title">{{ $productno }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> All Products
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">    
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Featured Products</p>
                    <h3 class="card-title">{{ $featno }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> All Featured Products
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Collections</p>
                    <h3 class="card-title">{{ $collectionno }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> All Collections
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="card-content">
                    <p class="category">Vendors</p>
                    <h3 class="card-title">{{ $vendorno }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> All Vendors
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 768px) {
        .row.equal {
            display: flex;
            flex-wrap: wrap;
        }
    }
</style>
<div class="container-fluid">

    <div class="row equal">
        <div class="col-md-4" style="height: 100%">
            <div class="card" style="height: 100%">
                <div class="card-header card-header-danger">
                    <h4 class="card-title"> <strong>Order Statistics</strong> </h4>
                </div>
                <hr style="margin-bottom: 0;">
                <div class="card-body" style="padding:1.5rem;">
                      <table class="table">
                        @for ($i = 0; $i < 7; $i++)
                            <tr>
                               
                                <td>
                                    <a href="{{route('admin.orders',['status'=>$i])}}">
                                        <i class="material-icons">{{\App\Setting\OrderManager::stageicons[$i]}}</i> {{\App\Setting\OrderManager::stages[$i]}} orders
                                    </a>
                                </td>
                                <td class="text-right">
                                    <strong>
                                        {{App\model\OrderItem::where('stage',$i)->count()}}
                                    </strong>
                                </td>
                            </tr>
                        @endfor
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header card-header-danger">
                    <h4 class="card-title"> 
                        <strong>Latest Orders</strong> -  
                        <strong>
                            <a href="{{route('admin.orders',['status'=>0])}}">View Orders</a>
                        </strong>
                    </h4>
                </div>
                <hr style="margin-bottom: 0;">
                <div class="card-body" style="padding:1.5rem;">
                      <table class="table">
                          <tr>
                              <th style="border: none;">
                                  Product
                              </th>
                              <th style="border: none;">
                                  Quantity
                              </th>
                              <th style="border: none;">
                                  Attributes
                              </th>
                              <th style="border: none;">

                              </th>
                          </tr>
                        @foreach ($latest as $order)
                            @php
                                $product=$order->product;
                            @endphp
                            <tr>
                                <td>
                                    {{$product->product_name}}
                                    <br>
                                    <strong style="color:#0acf21;">
                                        {{$order->created_at->diffForHumans()}}
                                    </strong>
                                </td>
                                <td>
                                    {{$order->qty}} Pcs
                                </td>
                                <td>
                                    {{ $order->variant() }}
                                </td>
                                <td>
                                    <div>
                                        {{\App\Setting\OrderManager::stages[$order->stage]}} 
                                    </div>
                                    <div>

                                        <strong>
                                            <a href="{{Route('admin.orders-flash',['status'=>$order->stage,'id'=>$order->shipping_detail_id])}}">Detail</a>
                                        </strong>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection