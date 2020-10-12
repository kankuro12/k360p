@extends('layouts.adminlayouts.admin-design')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
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
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">Popup</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Popup Info</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="content-view">
                        <form action="{{ route('popup.info') }}" role="form" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title"> Title <span style="color:red;">*</span></label>
                                <input type="text" name="title" value="{{ $pop!=null?$pop->title:"" }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="title"> Short Detail <span style="color:red;">*</span></label>
                                <input type="text" name="short_detail" value="{{$pop!=null? $pop->short_detail:"" }}" class="form-control" required>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{ asset($pop!=null?$pop->image:"")}}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                                <div>
                                    <span>Active Status</span> <!-- .switcher-control -->
                                    <input type="checkbox" name="status" {{ $pop!=null? ($pop->status?'checked':''):'' }}> 
                                </div>
                                <input type="submit" class="btn btn-outline btn-primary" id="add" value="Update">
                            </div>

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




@endsection

@section('scripts')



@endsection