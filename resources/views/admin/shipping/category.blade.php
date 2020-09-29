@extends('layouts.adminlayouts.admin-design')
@section('content')

    <br>
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <br>
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
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title"><a href="{{ route('admin.shippings') }}">Shippings</a> /
                            {{ $shipping->name }}</h4>
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="content-view">
                            <table class="table">
                                <thead>

                                    <tr>
                                        <th>Category Name</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\model\admin\Category::whereNull('parent_id')->get() as $category)
                                        <tr>
                                            <td>{{ $category->cat_name }}</td>
                                            <td>
                                                <a
                                                    href="{{ url('admin/shippings/manage/' . $shipping->id . '/category/' . $category->cat_id) }}">
                                                    Manage Shipping
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ url('admin/shippings/manage/' . $shipping->id . '/subcat/' . $category->id) }}">SubCategories</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
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
    <script>


    </script>
@endsection
