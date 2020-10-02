@extends('layouts.adminlayouts.admin-design')
@section('content')
<div class="container-fluid">
    <button id="create_modal" class="create_modal btn btn-fill btn-primary">Add Footer Link</button>
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
                    <i class="material-icons">footerhead</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Footer Head</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="content-view">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Footer Head Title</th>
                                        <th colspan="3" class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Footerhead::all() as $f)
                                    <tr>
                                        <form action="{{ route('header.update',$f->id) }}" method="POST">
                                            @csrf
                                            <td class="text-center">
                                                <input type="text" class="form-control" name="title" value="{{ $f->title }}">
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-sm">Update</button>
                                            </td>
                                        </form>
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


    <!-- link list -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">footerlink</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Footer Link List </h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="content-view">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Footer Link Title</th>
                                        <th class="text-center">Footer Parent Head</th>
                                        <th class="text-center">Link</th>
                                        <th colspan="3" class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Footerlink::all() as $l)
                                    <tr>
                                            <td class="text-center">{{ $l->title }}</td>
                                            <td class="text-center">{{ $l->head->title }}</td>
                                            <td class="text-center">{{ $l->link }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('link.delete',$l->id) }}" class="btn btn-primary btn-sm">delete</a>
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
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Footer Link </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('link.store') }}" role="form" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Link Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-12 pr-md-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Select Parent Header</label>
                                <select name="footerhead_id" class="form-control" required>
                                    <option></option>
                                    @foreach(\App\Footerhead::all() as $t)
                                    <option value="{{ $t->id }}">{{ $t->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 pr-md-1">
                                <div class="form-group label-floating">
                                    <h4 class="card-title">Footer Links</h4>
                                </div>
                                <div class="row">
                                    <div class="radio col-md-4">
                                        <label>
                                            <input type="radio" name="linkradio" value="1" onchange="organize()" id="customlinkradio"> Custom Link
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Custom Link</label>
                                            <input type="text" class="form-control" id="customlink" value="" name="custom_link" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="radio col-md-4">
                                        <label>
                                            <input type="radio" name="linkradio" value="2" onchange="organize()" id="brandradio"> Brand
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="brand" class="form-control" name="brands" data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
                                            <option selected disabled>Choose Brand</option>
                                            @foreach (\App\model\admin\Brand::all() as $brand)
                                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="radio col-md-4">
                                        <label>
                                            <input type="radio" name="linkradio" value="3" onchange="organize()" id="collectionradio"> Collection
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="collection" class="form-control" name="collections" data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
                                            <option disabled selected>Choose Collection</option>
                                            @foreach (\App\model\admin\Collection::all() as $collection)
                                            <option value="{{ $collection->collection_id }}">{{ $collection->collection_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="radio col-md-4">
                                        <label>
                                            <input type="radio" name="linkradio" value="4" onchange="organize()" id="saleradio"> Sale
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="sale" class="form-control" name="sales" data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
                                            <option disabled selected>Choose Sale</option>
                                            @foreach (\App\model\admin\Onsell::all() as $onsell)
                                            <option value="{{ $onsell->sell_id }}">{{ $onsell->sell_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="radio col-md-4">
                                        <label>
                                            <input type="radio" name="linkradio" value="5" onchange="organize()" id="categoryradio"> Category
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="category" class="form-control" name="categories" data-style="btn btn-primary" data-size="3" disabled=true>
                                            <option disabled selected>Choose Category</option>
                                            @foreach (\App\model\admin\Category::all() as $category)
                                            <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
<script type="text/javascript">
    $('#create_modal').click(function() {
        $('#create').modal('show');
    });

    function organize() {
        document.getElementById('customlink').disabled = !document.getElementById('customlinkradio').checked;
        document.getElementById('brand').disabled = !document.getElementById('brandradio').checked;
        document.getElementById('collection').disabled = !document.getElementById('collectionradio').checked;
        document.getElementById('sale').disabled = !document.getElementById('saleradio').checked;
        document.getElementById('category').disabled = !document.getElementById('categoryradio').checked;
    }
</script>


@endsection