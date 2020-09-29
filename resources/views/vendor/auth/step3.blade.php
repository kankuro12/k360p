@extends('vendor.step')
@section('content')
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <div style="padding:25px;">

            <div class="row">

                <div class="col-md-6  ">
                    <div class="form-group label-floating">
                        <label for="bankname">Bank Name</label>
                        <input type="text" class="form-control" placeholder="Bank Name" name="bankname" id="bankname"
                            required>
                    </div>
                </div>
                <div class="col-md-6  ">
                    <div class="form-group label-floating">
                        <label for="bankaccount">Bank Account no</label>
                        <input type="text" class="form-control" placeholder="Bank Account" name="bankaccount"
                            id="bankaccount" required>
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
                                <input onchange="loadImage(this)" style="display:none;" name="image" type="file" id="gal"
                                    accept="image/*"  />
                                <img src="/images/registration.png" alt="..." id="gal_img"
                                    onclick="document.getElementById('gal').click();" style="width: 100%;">
                            </div>
                            <div style="position: absolute;top:0px;right:0px;">
                                <span class="btn btn-danger" onclick="
                                                                    document.getElementById('gal').value = null;
                                                                    document.getElementById('gal_img').src='/images/registration.png';
                                                                    ">Clear</span>
                            </div>
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
                                <input onchange="loadImage1(this)" style="display:none;" name="image1" type="file" id="gal1"
                                    accept="image/*"  />
                                <img src="/images/citizenship.png" alt="..." id="gal_img1"
                                    onclick="document.getElementById('gal1').click();" style="width: 100%;">
                            </div>
                            <div style="position: absolute;top:0px;right:0px;">
                                <span class="btn btn-danger" onclick="
                                                                    document.getElementById('gal1').value = null;
                                                                    document.getElementById('gal_img1').src='/images/citizenship.png';
                                                                    ">Clear</span>
                            </div>
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

                    <input type="submit" class="btn btn-danger" value="Next">
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
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
                    document.getElementById('gal_img').src = '/images/registration.png';
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
                    document.getElementById('gal_img1').src = '/images/citizenship.png';
                    input.value = null;
                    console.log(input.files);
                } else {

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        }
    </script>

@endsection
