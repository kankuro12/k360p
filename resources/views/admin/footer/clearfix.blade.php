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
                    <i class="material-icons">clearfix</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Clearfix Info (Top Left)</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="content-view">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Link Title</th>
                                        <th>Link</th>
                                        <th colspan="3" class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Clearfix::get() as $c)
                                    <tr>
                                        <form action="{{ route('clearfix.update',$c->id) }}" method="POST">
                                            @csrf
                                            <td>
                                                <input type="text" class="form-control" name="title" value="{{ $c->title }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="link_title" value="{{ $c->link_title }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="link" value="{{ $c->link }}">
                                            </td>
                                            <td>
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


</div>





@endsection

@section('scripts')



@endsection