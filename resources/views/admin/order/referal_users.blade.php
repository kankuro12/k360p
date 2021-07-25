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
                    <h4 class="card-title">Referal Users</h4>
                    <div class="content-view">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Total Referal Value</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($referalUsers as $user)
                                    @php
                                        $ref_user = \App\model\vendoruser\VendorUser::where('user_id',$user->referal_id)->first();
                                        $referl_value = App\model\OrderItem::where('referal_id',$user->referal_id)->count();
                                    @endphp
                                <tr>
                                    <td>{{ $ref_user->fname }} {{ $ref_user->lname }}</td>
                                    <td>{{ $referl_value }}</td>
                                    <td>
                                        <a  class="btn btn-primary " href="{{ route('admin.referal.user.product',$user->referal_id) }}">Products</a>
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
