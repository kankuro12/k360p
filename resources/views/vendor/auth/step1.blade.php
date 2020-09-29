@extends('vendor.step')
@section('content')
    <form method="POST">
        @csrf
       <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4  text-center">
                <div class="form-group ">
                    
                    <input type="text" required class="form-control text-center" name="code" placeholder="Enter Activation Code" >
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
