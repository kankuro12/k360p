@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card" style="min-height: 200px;">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        @php
                        $data=$section->getElement();
                        $image="";
                        $text="";
                        $link="";
                        if($data!=null){
                            $image=$data->image1;
                            $text=$data->link2;
                            $link=$data->link1;
                        }
                        @endphp
                        <h4 class="card-title"> <a href="{{ route('elements') }}"><strong>Homepage Section</strong></a>/
                            Advertisment / <strong>{{ $section->name }}</strong></h4>
                        <div>
                            
                        </div>
                        <div class="content-view">
                            <div id="root">
                                <form enctype="multipart/form-data" action="{{ route('elements.save-ad', ['section' => $section->id]) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="">Advertisment Image</label>
                                            <div>
                                                <div style="position: relative">
                                                    <div>
                                                        <input onchange="loadImage(this)" style="display:none;" name="image"
                                                            type="file" id="gal" accept="image/*"  />
                                                        <img src="{{$image!=""?asset($image):'\images\backend_images\slider.png'}}" alt="..." id="gal_img"
                                                            onclick="document.getElementById('gal').click();">
                                                    </div>
                                                    <div style="position: absolute;top:0px;right:0px;">
                                                        <span class="btn btn-danger" onclick="
                                                                                            document.getElementById('gal').value = null;
                                                                                            document.getElementById('gal_img').src='{{$image!=""?asset($image):'\images\backend_images\slider.png'}}';
                                                                                            ">Clear</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group label-floating">
                                                <label>Button Text</label>
                                                <input required type="text" class="form-control"
                                                    name="link2" value="{{$text}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 pr-md-1">
                                            <div class="form-group label-floating">
                                                <h4 class="card-title">Button Link</h4>
                                            </div>
                                            <div>
                                                <h4>
                                                   <strong>
                                                       link : 
                                                    </strong> 
                                                    {{url($link)}}
                                                </h4>
                                                <hr>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="linkradio" value="1" onchange="organize()"
                                                            id="customlinkradio"> Custom Link
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                   
                                                        <input type="text" class="form-control" id="customlink" value=""
                                                            name="link" disabled>
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="linkradio" value="2" onchange="organize()"
                                                            id="brandradio"> Brand
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="brand" class="form-control" name="link"
                                                        data-style="btn btn-primary" title="Single Select" data-size="7"
                                                        disabled>
                                                        <option selected disabled>Choose Brand</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="linkradio" value="3" onchange="organize()"
                                                            id="collectionradio"> Collection
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="collection" class="form-control" name="link"
                                                        data-style="btn btn-primary" title="Single Select" data-size="7"
                                                        disabled>
                                                        <option disabled selected>Choose Collection</option>
                                                        @foreach ($collections as $collection)
                                                            <option value="{{ $collection->collection_id }}">
                                                                {{ $collection->collection_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="linkradio" value="4" onchange="organize()"
                                                            id="saleradio"> Sale
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="sale" class="form-control" name="link"
                                                        data-style="btn btn-primary" title="Single Select" data-size="7"
                                                        disabled>
                                                        <option disabled selected>Choose Sale</option>
                                                        @foreach ($onsells as $onsell)
                                                            <option value="{{ $onsell->sell_id }}">{{ $onsell->sell_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="linkradio" value="5" onchange="organize()"
                                                            id="categoryradio"> Category
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="category" class="form-control" name="link"
                                                        data-style="btn btn-primary" data-size="3" disabled=true>
                                                        <option disabled selected>Choose Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->cat_id }}">
                                                                {{ $category->cat_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 pr-md-1">
                                            <input type="submit" class="btn btn-fill btn-primary" value="submit">
                                        </div>
                                    </div>
                                </form>
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
                document.getElementById('gal_img').src = '{{$image!=""?asset($image):'\images\backend_images\slider.png'}}';
                input.value = null;
                console.log(input.files);
            } else {

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    }
</script>
@endsection
