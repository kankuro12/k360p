@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="col-sm-10 col-sm-offset-1">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Add Product</h4>
                        <form action="{{ route('admin.create-product') }}" method="post" enctype="multipart/form-data">
@csrf


                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        
                                        <select class="selectpicker" data-live-search="true" id="exampleFormControlSelect1"
                                            name="stocktype" data-style="btn btn-primary " title="Select Stock Type"
                                            data-size="3" required>
                                            <option value="0">Simple</option>
                                            <option value="1">Variant</option>
                                        </select>
                                    </div>
                                </div>
                           
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label > <strong>Product Name</strong> </label>
                                        <input type="text" class="form-control" value="" name="product_name" required placeholder="Enter Product Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                      
                                        <select class="selectpicker" data-live-search="true" id="exampleFormControlSelect1"
                                            name="brand_id" data-style="btn btn-primary " title="Select Product Brand"
                                            data-size="3">
                                            <?php echo $branddropdown; ?>
                                        </select>
                                    </div>
                                </div>
                           
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group">
                                       
                                        <select class="selectpicker" data-live-search="true" id="exampleFormControlSelect1"
                                            name="category_id" data-style="btn btn-primary " title="Select Product Category"
                                            data-size="3" required>
                                            <?php echo $categorydropdown; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label ><strong>Product SKU</strong> </label>
                                        <input type="text" class="form-control" value="" name="product_sku" placeholder="Enter Product SKU">
                                    </div>
                                </div>
                          
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label ><strong>Product Mark Price</strong> </label>
                                        <input required type="text" class="form-control" value="" name="mark_price" placeholder="Enter Product Price">
                                    </div>
                                </div>
                            
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label ><strong>Product sale Price</strong> </label>
                                        <input required type="text" class="form-control" value="" name="sell_price" placeholder="Enter Product Promotional Price">
                                    </div>
                                </div>
                            
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label ><strong>Product Quantity</strong> </label>
                                        <input required type="text" class="form-control" value="0" name="quantity" placeholder="Enter Quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="attributeitem"> <strong>Tags (Separate With Comma)</strong> </label>
                                    <div class="form-control">
                                        <input name="tags" class="form-control" required data-role="tagsinput" name="attributeitem" id="attributeitem" required />
                                    </div>
                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for=""> <strong>Shipping Method</strong> </label>
                                    <select class="selectpicker" data-live-search="true" id="shipping_class_id" name="shipping_class_id"
                                        data-style="btn btn-primary " title="Select A shipping Method" data-size="3" required onchange="
                                        $('#w_class').text($(this).find(':selected').attr('data-wclass'));
                                        $('.d_class').text($(this).find(':selected').attr('data-dclass'));
                                        ">
                                        @foreach (App\Shippingclass::all() as $item)
                                            <option  data-wclass="{{ $item->weightclass }}" data-dclass="{{$item->dimensionclass}}" value="{{ $item->id }}" >
                                                {{ $item->name}}</option>
                                        @endforeach
                                    </select>
                    
                                </div>
                    
                            </div>
                            <div >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""> <strong>Weight <span id="w_class"></span></strong>  </label>
                                            <input required type="number" step="0.01" name="weight" class="form-control" placeholder="Enter Product Weight">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> <strong> Length <span class="d_class"></span> </strong> </label>
                                            <input required type="number" step="0.01" name="l" class="form-control"  placeholder="Enter Package Length" >
                    
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> <strong>Height <span class="d_class"></span></strong> </label>
                                            <input required type="number" step="0.01" name="h" class="form-control" placeholder="Enter Package Height" >
                    
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> <strong>width <span class="d_class"></span></strong> </label>
                                            <input required type="number" step="0.01" name="w" class="form-control" placeholder="Enter Package Length">
                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label > <strong>Short Description</strong> </label>
                                        <textarea id="product-short-desc" class="form-control"
                                            name="product_short_description" required placeholder="Enter Short Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label > <strong>Description</strong> </label>
                                        <textarea id="product-desc" class="form-control"
                                            name="product_description" placeholder="Enter Full Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label for=""> <strong>Primary Image (800 x 600)</strong> </label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('images/backend_images/image_placeholder.jpg') }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input required type="file" name="product_main_images"  accept="image/*"/>
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div>
                                        <label for="images"> <strong>Gallery Images (800 x 600)</strong> </label>
                                        <div class="row" id="images">
                                            @for ($i = 0; $i < env('productimage_count'); $i++)
                                                <div class="col-md-6 h-100" style="margin-bottom: 5px;min-height:180px;">
                                                    <div style="position: relative">
                                                        <div >
                                                            <input onchange="loadImage(this,{{$i}})" v="{{$i}}" style="display:none;" name="product_images[]" type="file" id="gal_{{$i}}" accept="image/*"/>
                                                            <img src="{{ asset('images/backend_images/add_image.png') }}" alt="..." id="gal_img_{{$i}}" 
                                                            onclick="document.getElementById('gal_{{$i}}').click();">
                                                        </div>
                                                        <div style="position: absolute;top:0px;right:0px;">
                                                            <span class="btn btn-danger"
                                                            onclick="
                                                            document.getElementById('gal_{{$i}}').value = null;
                                                            document.getElementById('gal_img_{{$i}}').src='{{ asset('images/backend_images/add_image.png') }}';
                                                            "
                                                            >Clear</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Add Product</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- wizard container -->
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/backend-js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('product-desc');
        function loadImage(input,i){
            console.log(input,i);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#gal_img_'+i).attr('src', e.target.result);
                }
                var FileSize = input.files[0].size  / 1024; 
                if(FileSize>{{env('productimage_size')}}){
                    alert('Image Size Cannot Be Greater than 600kb');
                    document.getElementById('gal_img_'+i).src='{{ asset('images/backend_images/add_image.png') }}';
                    input.value=null;
                    console.log(input.files);
                }else{

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }
    </script>
@endsection
