@extends('layouts.adminlayouts.admin-design')
@section('content')
@php
   $items=\App\model\admin\Product::where('isverified',1)->get();
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
                <span>
                    <b> Success - </b>{!! session('flash_message') !!}</span>
            </div>
            @endif

            <div class="card" style="min-height: 200px;">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">

                    <h4 class="card-title">
                        Make a Order / <strong>Vendor order</strong></h4>
                    <div>

                    </div>
                    <div class="content-view">
                        <div id="root">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="search" id="name" class="form-control"  placeholder="Search Products" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select id="category" class="form-control">
                                                    <option value="-1">Select a Category</option>
                                                    @foreach ($cats as $cat)
                                                        <option value="{{$cat->cat_id}}">{{$cat->cat_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <button class="btn btn-success" onclick="searchProduct()">
                                                    Search
                                               </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="searchresult">

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <table class="table">
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                        <tbody id="customsitems">
                                            @foreach ($items as $item)
                                                @include('vendor.make_a_order.item',['item'=>$item])
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

@section('scripts')
    <script>
        function searchProduct(){
            $('#searchresult').html("");

                $.ajax({
                    url: "{{route('vendor.product.search')}}",
                    data: {
                        'name':$('#name').val(),
                        "category":$("#category").val()
                    },

                    type: 'POST',

                    success: function (response) {
                        console.log(response);
                        $('#searchresult').html(response);

                    }
                });

        }

        function addItem(id){
            $.ajax({
                    url: "",
                    data: {
                        'id':id
                    },

                    type: 'POST',

                    success: function (response) {
                        console.log(response);
                        $('#customsitems').append(response);

                    }
                });

        }

        function removeItem(id){
            $.ajax({
                    url: "{{url('admin/element/custom/remove')}}"+"/"+id,
                    type: 'get',
                    success: function (response) {
                        console.log(response);
                        $('#item-'+id).remove();
                    }
                });

        }
    </script>
@endsection

