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
                    <i class="material-icons">blog</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Blog Edit</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="content-view">
                        <form action="{{ route('blog.edit',$blog->id) }}" role="form" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Blog Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $blog->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">post By</label>
                                        <input type="text" class="form-control" name="post_by" value="{{ $blog->post_by }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ $blog->published }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tags</label>
                                        <input type="text" class="form-control" name="tag" value="{{ $blog->tag }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12 pr-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Detail</label>
                                        <textarea id="blog-desc" class="form-control" name="desc">{{ $blog->desc }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="">Feature Image</label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset($blog->image) }}" alt="...">
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
                                </div>
                            </div>

                    </div>
                    <input type="submit" class="btn btn-outline btn-primary" id="add" value="Update">
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
<script src="{{ asset('js/backend-js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace('blog-desc');
</script>


@endsection