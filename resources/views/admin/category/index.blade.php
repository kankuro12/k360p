@extends('layouts.adminlayouts.admin-design')
@section('content')

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
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Categories</h4>
                    <div class="toolbar">
                        <button class="btn btn-primary create_modal" >Add Root Cateogry</button>
                    </div>
                    <div class="content-view">
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-left" >Name</th>
                                    <th class="text-left">Referal Charge</th>
                                    <th class="text-left">image</th>
                                    {{-- <th class="text-left">Parent Category</th> --}}
                                    <th class="disabled-sorting text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="text-left"><a href="{{route('admin.manage-subcategory',['id'=>$category->cat_id])}}">{{ $category->cat_name }}</a></td>
                                    <td class="text-left">{{ $category->referal_charge }}</td>
                                    <td class="text-left"><img style="max-width: 120px;" src="{{ asset( $category->cat_image) }}" alt=""></td>
                                    {{-- <td class="text-left"><span class="label label-primary">{{ $category->parentlists }}</span></td> --}}
                                    <td class="text-left">
                                        <a href="{{ url('admin/edit-category1/'.$category->cat_id) }}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn  btn-just-icon btn-round btn-primary"><i class="material-icons">border_color</i></a>
                                        {{-- @if($category->parent_id==null) --}}
                                        <a href="{{route('admin.closingcharges',['category'=>$category])}}" data-toggle="tooltip" data-placement="left" title="Closing Charges" class="btn  btn-just-icon btn-round btn-secondary"><i class="material-icons">attach_money</i></a>
                                        <span class="dropdown show" style="display: inline-block !important;">
                                            <a class="btn btn-secondary btn-just-icon btn-round btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" title="Shipping Methods" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">local_shipping</i>
                                            </a>
                                            <a class="btn  btn-just-icon btn-round btn-danger"  href="{{route('admin.del-category',['cat'=>$category->cat_id])}}" role="button" id="dropdownMenuLink" title="Delete Category"  aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">delete_forever
                                                </i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @foreach (\App\ShippingClass::all() as $item)
                            
                                                    <a class="dropdown-item" href="{{route('admin.shipping-manage-category',['shipping'=>$item->id,'category'=>$category->cat_id])}}" style="padding-left:5px;"> <strong>{{$item->name}}</strong></a>
                                                @endforeach
                                                
                                            </div>
                                        </span>    
                                        {{-- @endif --}}
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

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.add-category1') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label for="">Image (75 x 75 px)</label>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('images/backend_images/image_placeholder.jpg') }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div>
                                <span class="btn btn-rose btn-round btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input required type="file" name="cat_image" />
                                </span>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                    data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        
                            <div class=" pr-md-1">
                                <div class="form-group label-floating">
                                    <label class="control-label">Category Name</label>
                                    <input type="text" class="form-control" value="" name="cat_name" required>
                                </div>
                            </div>

                            <div class=" pr-md-1">
                                <div class="form-group label-floating">
                                    <label class="control-label">Referal Charge</label>
                                    <input type="number" min="0" class="form-control" value="" name="referal_charge" required>
                                </div>
                            </div>
                       

                      
                            <div class="">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <textarea  rows="4" cols="80" class="form-control"
                                        name="cat_description"></textarea>
                                </div>
                            </div>
                       
                            
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-center pr-md-1">
                        <input type="submit" class="btn btn-fill btn-primary" value="submit">
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
  <!-- End of Modal -->

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.create_modal',function(){
        $('#create').modal('show');
        $('.formgroup').show();
    });
});
</script>
@endsection