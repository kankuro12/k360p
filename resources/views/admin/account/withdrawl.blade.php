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
           <i class="material-icons">mail_outline</i>
        </div>

        <div class="card-content">
            <h4 class="card-title">
                <strong>
                    <a href="{{route('admin.account')}}">Finance</a>
                </strong> /
                <strong>
                    <a href="{{route('admin.vendor-details',['id'=>$account->vendor->user->id])}}">{{$account->vendor->name}}</a>

                </strong> /

                <strong>
                    <a href="{{route('admin.detail',['id'=>$account->vendor->id])}}">Finance Details</a>

                </strong> /

                
                Add Withdraw
            </h4>
            <form action="{{ route('admin.savewithdrawl',['id'=>$account->vendor->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label >
                            Amount
                        </label>
                        <input class="form-control" required min="{{env('minwithdrawl',100)}}" value="{{$account->withdraw()}}" max="{{$account->withdraw()}}" type="number" name="amount" id="amount" required>
                    </div>
                    @foreach ($attributes as $attribute)
                    <div class="col-md-6">
                        <label >
                            {{$attribute}}
                        </label>
                        <input class="form-control" required type="text" name="{{$attribute}}" id="{{$attribute}}">
                    </div>
                    @endforeach
                   
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <h4 >Image of proof</h4>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail">
                                <img src="{{ asset('images/backend_images/image_placeholder.jpg') }}" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div>
                                <span class="btn btn-rose btn-round btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input required type="file" name="image" required />
                                </span>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                    data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 pr-md-1">
                        <input type="submit" class="btn btn-fill btn-primary" value="Withdraw Amount">
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script>
   
</script>
@endsection