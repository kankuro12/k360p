@extends('layouts.adminlayouts.admin-design')

@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="red">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Referal Products</h4>
                    <div class="content-view">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Rate</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Product Name</th>
                                    <th>Rate</th>
                                    <th>Quantity</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($referalProduct as $product)
                                    @php
                                        $ref_user = \App\model\vendoruser\VendorUser::where('user_id',$product->referal_id)->first();
                                        $referl_value = App\model\OrderItem::where('referal_id',$product->referal_id)->count();
                                    @endphp
                                <tr>
                                    <td><img src="{{ asset($product->product->product_images) }}" alt="" style="height: 150px;width:150px;"></td>
                                    <td>{{ $product->product->product_name }}</td>
                                    <td>
                                        Rs.{{ $product->rate }}
                                    </td>
                                    <td>
                                        {{ $product->qty }}
                                    </td>
                                    {{-- <td class="text-right">
                                        <a  class="add-modal btn btn-primary " href="{{ url('admin/add-sale-products/'.$sale->sell_id) }}">Add</a>
                                        <a  class="view-modal btn btn-info " href="{{ url('admin/edit-sale-products/'.$sale->sell_id) }}">View</a>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
</div>
@endsection
