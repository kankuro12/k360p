@extends('layouts.adminlayouts.admin-design')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if (Session::has('flash_message'))
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
                            <a href="{{route('admin.manage-category1')}}"> Categories</a> 
                            /
                            @if ($data->parentlists!="")
                            {!!$data->parentlists!!} 
                            
                            @endif

                            {{$data->cat_name}} / Edit Category </h4>
                        <form action="{{ route('admin.edit-category1',['id'=>$data->cat_id]) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Category Name</label>
                                        <input type="text" class="form-control" value="{{ $data->cat_name }}"
                                            name="cat_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Referal Charge</label>
                                        <input type="text" class="form-control" step="0.01" value="{{ $data->referal_charge }}"
                                            name="referal_charge">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Description</label>
                                        <textarea rows="4" cols="80" class="form-control"
                                            name="cat_description">{{ $data->cat_description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <label for="">Image</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset($data->cat_image) }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="cat_image" />
                                                <input type="hidden" name="catagory_image" value="{{ $data->cat_image }}">
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
