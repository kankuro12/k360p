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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">menu</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Add Menu</h4>
                        <form action="{{ route('admin.add-menu') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Menu Name</label>
                                        <input type="text" class="form-control" name="menu_name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label>
                                        <input type="radio" name="type" value="0" onchange="organize()" id="brandradio">
                                        Brand
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="brand" class="form-control" name="parent_id" data-style="btn btn-primary"
                                        title="Single Select" data-size="7" disabled>
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
                                        <input type="radio" name="type" value="2" onchange="organize()"
                                            id="collectionradio"> Collection
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="collection" class="form-control" name="parent_id"
                                        data-style="btn btn-primary" title="Single Select" data-size="7" disabled>
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
                                        <input type="radio" name="type" value="3" onchange="organize()" id="saleradio">
                                        Sale
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="sale" class="form-control" name="parent_id" data-style="btn btn-primary"
                                        title="Single Select" data-size="7" disabled>
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
                                        <input type="radio" name="type" value="1" onchange="organize()" id="categoryradio">
                                        Category
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select id="category" class="form-control" name="parent_id" data-style="btn btn-primary"
                                        data-size="3" disabled=true>
                                        <option disabled selected>Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->cat_id }}">
                                                {{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" value="Add Menu" class="btn btn-primary">
                                </div>
                            </div>

                        </form>
                    </div>
                    {{-- {{ $menuPrinter->buildMenu() }} --}}
                </div>

                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">menu</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Menu Lists</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="items-list">
                                    @foreach ($menus as $menu)
                                        <li class="" style="border-bottom:#bbb 1px solid;padding:10px;">
                                            {{ $menu->menu_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function organize() {
            document.getElementById('brand').disabled = !document.getElementById('brandradio').checked;
            document.getElementById('collection').disabled = !document.getElementById('collectionradio').checked;
            document.getElementById('sale').disabled = !document.getElementById('saleradio').checked;
            document.getElementById('category').disabled = !document.getElementById('categoryradio').checked;
        }

    </script>
@endsection
