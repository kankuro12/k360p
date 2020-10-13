@extends('layouts.adminlayouts.admin-design')
@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-md-12">
            @if (Session::has('msg'))
                <div class="alert alert-success">{{ Session::get('msg') }}</div>
            @endif
            <a href="{{url('admin/add-product')}}" class="create_modal btn btn-fill btn-primary" >Add Product</a>
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Products</h4>
                    <div class="content-view">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="selectpicker" data-live-search="true" id="brand-search" name="brandsearch" data-style="btn btn-rose" title="Search By Brand" data-size="3">
                                        {!! $branddropdown !!}
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="selectpicker" data-live-search="true" id="category-search" name="categorysearch" data-style="btn btn-rose" title="Search By Category" data-size="3">
                                        {!! $categorydropdown !!}
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="selectpicker" data-live-search="true" id="rate-search" name="ratesearch" data-style="btn btn-rose" title="Search By Rating" data-size="3">
                                        <option disabled selected>Search by Ratings</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="selectpicker" data-live-search="true" id="stock-status-search" name="stocksearch" data-style="btn btn-rose" title="Single Select" data-size="3">
                                        {!! $statusdropdown !!}
                                    </select>
                                </div>
                            </div>
                            <thead>
                                <tr>
                                    <th class="text-left">Code</th>
                                    
                                    <th class="text-left">Store</th>
                                    <th class="text-left">Name</th>
                                    {{-- <th class="text-left">image</th> --}}
                                    <th class="text-left">Brand</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-left">Featured</th>
                                    <th class="disabled-sorting text-left">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-left">#{{ $product->product_id }}</td>
                                    <td class="text-left">{{ $product->vendor_name }}</td>
                                    <td class="text-left">{{ $product->product_name }}</td>
                                    {{-- <td class="text-left"><img style="max-width: 120px;" src="{{ asset('images/backend_images/products/main_image/'.$product->product_images) }}" alt=""></td> --}}
                                    <td class="text-left">{{ $product->brand_name }}</td>
                                    {{-- <td class="text-left">{{ $product->stock_status_name }}</td> --}}
                                    <td class="text-left">{{ $product->quantity }}</td>
                                    <td class="text-left"><input type="checkbox" name="featured" value='{{ $product->featured }}' onchange="setfet(this)" data-id ="{{ $product->product_id }}" @if($product->featured == 1) checked  @endif >
                                        <span class="label label-primary @if ($product->featured == 0)hidden @endif">Featured</span> 
                                    </td>
                                    <td class="text-left">
                                        <a href="{{ url('/admin/view-product/'. $product->product_id) }}" data-toggle="tooltip" data-placement="top" title="View" class="btn  btn-just-icon btn-round btn-rose"><i class="material-icons">view_list</i></a>
                                        {{-- <a href="{{ url('/admin/edit-product/'.$product->product_id) }}" data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-just-icon  btn-round btn-primary"><i class="material-icons">border_color</i></a> --}}
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-just-icon  btn-round btn-danger"><i class="material-icons">delete_forever</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

@endsection
@section('scripts')
<script>
    
    function setfet(p){
        //console.log(p.value);
       
        //console.log(p.dataset.id);
        if(p.value == 1){
            //console.log('featured');
            
            p.value = 0;
        }else if(p.value == 0){
            //console.log('unfeatured');
            p.value = 1;
        }

        $.ajax({
            type: 'post',
            url: '/admin/setfeatured',
            data: { 'feature': p.value, 'product_id': p.dataset.id },
            success: function(data){
                if(p.value==1){
                    $(p).siblings("span").removeClass("hidden");
                }else{
                    $(p).siblings("span").addClass("hidden");
                }
            },

        });
    }
</script>

@endsection