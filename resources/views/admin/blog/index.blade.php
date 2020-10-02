@extends('layouts.adminlayouts.admin-design')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <button id="create_modal" class="create_modal btn btn-fill btn-primary">Create New Blog</button>
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
                    <h4 class="card-title">Blogs</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="content-view">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Post By</th>

                                        <th colspan="3" class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Blog::all() as $p)
                                    <tr>
                                        <td class="text-center">{{ $p->title}}</td>
                                        <td class="text-center">{{ $p->published}}</td>
                                        <td class="text-center">{{ $p->post_by}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('blog.edit',$p->id) }}" data-toggle="tooltip" data-placement="left" class="btn  btn-just-icon btn-round btn-secondary"><i class="material-icons">Edit</i></a>
                                            <a href="{{ route('blog.delete',$p->id) }}" data-toggle="tooltip" data-placement="left" class="btn  btn-just-icon btn-round btn-secondary"><i class="material-icons">Delete</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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


<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Blog </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('blog.store') }}" role="form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Blog Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">post By</label>
                                <input type="text" class="form-control" name="post_by" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                        </div>
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Tags</label>
                                <input type="text" class="form-control" name="tag" required>
                            </div>
                        </div>
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Detail</label>
                                <textarea id="blog-desc" class="form-control" name="desc"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="">Feature Image</label>
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="{{ asset('images/backend_images/image_placeholder.jpg') }}" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                    <span class="btn btn-rose btn-round btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input required type="file" name="image" />
                                    </span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline btn-danger" data-dismiss="modal" value="Close">
                <input type="submit" class="btn btn-outline btn-primary" id="add" value="save">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal -->


@endsection

@section('scripts')
<script src="{{ asset('js/backend-js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $('#create_modal').click(function() {
        $('#create').modal('show');
    });
    CKEDITOR.replace('blog-desc');
</script>


@endsection