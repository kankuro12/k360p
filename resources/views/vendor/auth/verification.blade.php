@extends('layouts.sellerlayouts.seller-design')
@section('content')
    @php
        $v=$vendor->verified!=1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">beenhere</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">{{$v?"Edit ":"View "}} Verification Detail</h4>
                        <div>
                            @if ($v)
                                
                            <form method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <br>
                                <div style="padding:25px;">
                        
                                    <div class="row">
                        
                                        <div class="col-md-6  ">
                                            <div class="form-group label-floating">
                                                <label for="bankname">Bank Name</label>
                                                <input type="text" class="form-control" placeholder="Bank Name" name="bankname" id="bankname"
                                                    required value="{{$verification!=null?$verification->bankname:''}}" {{!$v?"readonly":""}}>
                                            </div>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div class="form-group label-floating">
                                                <label for="bankaccount">Bank Account no</label>
                                                <input type="text" class="form-control" placeholder="Bank Account" name="bankaccount"
                                                    id="bankaccount" required value="{{$verification!=null?$verification->bankaccount:''}}" {{!$v?"readonly":""}}>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-6  ">
                                            <div class="form-group label-floating">
                                                <div>
                                                    <h3>
                                                        Registration Document
                                                    </h3>
                                                </div>
                                                <div style="position: relative">
                                                    <div>
                                                        @if ($v)
                                                            
                                                        <input onchange="loadImage(this)" style="display:none;" name="image" type="file" id="gal"
                                                        accept="image/*"  />
                                                        @endif
                                                        <img src="{{asset($verification!=null?$verification->registration:'')}}" alt="..." id="gal_img"
                                                            onclick="document.getElementById('gal').click();" style="width: 100%;">
                                                    </div>
                                                    @if ($v)
                                                        
                                                    <div style="position: absolute;top:0px;right:0px;">
                                                        <span class="btn btn-danger" onclick="
                                                                                            document.getElementById('gal').value = null;
                                                                                            document.getElementById('gal_img').src='{{$verification!=null?asset($verification->registration:'')}}';
                                                                                            ">Clear</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-6  ">
                                            <div class="form-group label-floating">
                                                <div>
                                                    <h3>
                                                       citizenship
                                                    </h3>
                                                </div>
                                                <div style="position: relative">
                                                    <div>
                                                        @if ($v)
                                                            
                                                        <input onchange="loadImage1(this)" style="display:none;" name="image1" type="file" id="gal1"
                                                            accept="image/*"  />
                                                        @endif
                                                        <img src="{{asset($verification!=null?$verification->citizenship:'')}}" alt="..." id="gal_img1"
                                                            onclick="document.getElementById('gal1').click();" style="width: 100%;">
                                                    </div>
                                                    @if ($v)
                                                        
                                                    <div style="position: absolute;top:0px;right:0px;">
                                                        <span class="btn btn-danger" onclick="
                                                                                            document.getElementById('gal1').value = null;
                                                                                            document.getElementById('gal_img1').src='{{asset($verification!=null?$verification->citizenship:'')}}';
                                                                                            ">Clear</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                        
                        
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4  text-center">
                                        <div class="form-group ">
                                            @if ($v)
                                                
                                                <input type="submit" class="btn btn-danger" value="Save">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if ($v)
                                    
                            </form>
                                @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
   @if ($v)
   <script>
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
                document.getElementById('gal_img').src = '{{asset($verification!=null?$verification->registration:'')}}';
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
                document.getElementById('gal_img1').src = '{{asset($verification!=null?$verification->citizenship:'')}}';
                input.value = null;
                console.log(input.files);
            } else {

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    }
</script>
   @endif
@endsection
