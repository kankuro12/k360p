@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card" style="min-height: 200px;">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Mobile Homepage Section</h4>
                        <form action="{{route('elements.mob.add')}}" method="post" class="inline-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Section Type</label>
                                        <select name="type" id="type" class="form-control" required>
                                            @foreach ($sectiontypes as $key=>$type)
                                                <option value="{{$type}}">{{$key}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Order</label>
                                        <input value="0" type="number" name="order" id="order" class="form-control"  required >
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <button class="btn btn-primary" onclick="showModal(0)">Add Setion</button>
                                </div>
                            </div>
                        </form>
                        <div>
                        </div>
                     
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>

                <div class="card " style="padding:15px;">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>
                                Title
                            </strong>
                        </div>
                        <div class="col-md-4">
                            <strong>
                                Type
                            </strong>
                        </div>
                        <div class="col-md-2">
                            <strong>

                                Order
                            </strong>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <hr>
                    @foreach ($sections as $section)
                    <form action="{{route('elements.mob.edit',['section'=>$section->id])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$section->name}}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="type" id="type" class="form-control" disabled >
                                        @foreach ($sectiontypes as $key=>$type)
                                            <option value="{{$type}}" {{$type==$section->type?"selected":""}}>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input required value="{{$section->order}}" type="number" name="order" id="order" class="form-control"  Order>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-link">update</button> |
                                <a href="{{route('elements.mob.manage',['section'=>$section->id])}}" >Manage </a>|
                                <a href="{{route('elements.mob.del',['section'=>$section->id])}}" >Delete </a>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>

    
    <!--Add Tag  Modal -->
@endsection

@section('scripts')

@endsection
