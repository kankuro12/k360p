@extends('layouts.adminlayouts.admin-design')

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
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
            <div class="card-header card-header-icon" data-background-color="rose">
               <i class="material-icons">view_carousel</i>
            </div>
    
            <div class="card-content">
                <h4 class="card-title">Update Slider</h4>
                <form action="{{ route('elements.update-slider',['slider'=>$slider->id]) }}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                            <label >Primary Text</label>
                            <input type="text" value="{{$slider->primary_text}}" class="form-control"  name="primary_text" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                            <label >Secondary Text</label>
                            <textarea type="text" class="form-control" name="secondary_text" required>{{$slider->secondary_text}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <label for="">Slider Image</label>
                            <div>
                                <div style="position: relative">
                                    <div>
                                        <input onchange="loadImage(this)" style="display:none;" name="image" type="file"
                                            id="gal" accept="image/*"  />
                                        <img src="{{asset($slider->slider_image)}}" alt="..." id="gal_img"
                                            onclick="document.getElementById('gal').click();">
                                    </div>
                                    <div style="position: absolute;top:0px;right:0px;">
                                        <span class="btn btn-danger" onclick="
                                                                        document.getElementById('gal').value = null;
                                                                        document.getElementById('gal_img').src='{{asset($slider->slider_image)}}';
                                                                        ">Clear</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="">Slider Mobile Image</label>
                            <div>
                                <div style="position: relative">
                                    <div>
                                        <input onchange="loadImage1(this)" style="display:none;" name="mobile" type="file"
                                            id="gal1" accept="image/*"  />
                                        <img src="{{asset($slider->mobile)}}" alt="..." id="gal_img1"
                                            onclick="document.getElementById('gal1').click();">
                                    </div>
                                    <div style="position: absolute;top:0px;right:0px;">
                                        <span class="btn btn-danger" onclick="
                                                                        document.getElementById('gal1').value = null;
                                                                        document.getElementById('gal_img1').src='{{asset($slider->mobile)}}';
                                                                        ">Clear</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                            <label >Button Text</label>
                            <input required type="text" class="form-control"   name="button_text" value="{{$slider->button_text}}">
                            </div>
                        </div>
                        <div class="col-md-3 col-6 ">
                            <div class="form-group label-floating">
                            <label >Button Background</label>
                            <input required type="color" class="form-control"  value="{{$slider->button_bg}}" name="button_bg">
                            </div>
                        </div>
                        <div class="col-md-3 col-6 ">
                            <div class="form-group label-floating">
                            <label >Button text Color</label>
                            <input required type="color" class="form-control"  value="{{$slider->button_color}}" name="button_color">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                                <h4 class="card-title">Slider Links</h4>
                            </div>
                            <p>
                                <h5>
                                    <strong>
                                        Current Link :
                                    </strong>
                                    <span>
                                        <a href="{{url($slider->link_text)}}">{{url($slider->link_text)}}</a>
                                    </span>
                                </h5>
                            </p>
                            <div class="row">
                                <div class=" col-md-4">
                                    <label>
                                        <input type="radio" name="linkradio" value="1" onchange="organize()" id="customlinkradio"> Custom Link
                                    </label>
                                </div>
                                <div class="col-md-8">
                                   
                                    
                                    <input type="text" placeholder="Enter Custom Link" class="form-control" id="customlink" value="" name="link" disabled>
                                   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="linkradio" value="2" onchange="organize()" id="brandradio"> Brand
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="brand" class="form-control" name="link" data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
                                        <option selected disabled>Choose Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="linkradio" value="3" onchange="organize()" id="collectionradio"> Collection
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="collection" class="form-control" name="link" data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
                                        <option disabled selected>Choose Collection</option>
                                        @foreach ($collections as $collection)
                                            <option value="{{ $collection->collection_id }}">{{ $collection->collection_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="linkradio" value="4" onchange="organize()" id="saleradio"> Sale
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="sale" class="form-control" name="link" data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
                                        <option disabled selected>Choose Sale</option>
                                        @foreach ($onsells as $onsell)
                                            <option value="{{ $onsell->sell_id }}">{{ $onsell->sell_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="linkradio" value="5" onchange="organize()" id="categoryradio"> Category
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="category" class="form-control" name="link"  data-style="btn btn-primary" data-size="3" disabled=true>
                                        <option disabled selected>Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-8 pr-md-1">
                    <input type="submit" class="btn btn-fill btn-primary" value="update">
                    </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>  
</div>
@endsection
@section('scripts')
    <script>
        function organize(){
            document.getElementById('customlink').disabled= !document.getElementById('customlinkradio').checked;
            document.getElementById('brand').disabled= !document.getElementById('brandradio').checked;
            document.getElementById('collection').disabled= !document.getElementById('collectionradio').checked;
            document.getElementById('sale').disabled= !document.getElementById('saleradio').checked;
            document.getElementById('category').disabled= !document.getElementById('categoryradio').checked;
        }

        function loadImage(input) {
            console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#gal_img').attr('src', e.target.result);
                }
                var FileSize = input.files[0].size / 1024;
                if (FileSize > 3072) {
                    alert('Image Size Cannot Be Greater than 3mb');
                    document.getElementById('gal_img').src = '{{asset($slider->slider_image)}}';
                    input.value = null;
                    console.log(input.files);
                } else {

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }

        function loadImage1(input) {
            console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#gal_img1').attr('src', e.target.result);
                }
                var FileSize = input.files[0].size / 1024;
                if (FileSize > 3072) {
                    alert('Image Size Cannot Be Greater than 3mb');
                    document.getElementById('gal_img1').src = '{{asset($slider->mobile)}}';
                    input.value = null;
                    console.log(input.files);
                } else {

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }
    </script>
@endsection