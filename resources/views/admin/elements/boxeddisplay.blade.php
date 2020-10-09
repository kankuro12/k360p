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
                        @php
                        $data=$section->getElement();
                        @endphp
                        <h4 class="card-title"> <a href="{{ route('elements') }}"><strong>Homepage Section</strong></a>/
                            Boxed Item / <strong>{{ $section->name }}</strong></h4>
                        <div>
                           
                        </div>
                        <div class="content-view">
                            <div id="root" style="padding:20px;border: #f1f1f1 1px solid;border-radius:10px;">
                              <form action="{{route('elements.save-boxed',['section'=>$data->id])}}" method="post">
                                @csrf

                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label >
                                                <input type="checkbox" name="hascategory" id="hascategory" value="1"> Has Category
                                            </label>
                                            <select name="category_id" id="category_id" class="selectpicker " data-live-search="true"  data-style="btn btn-primary"
                                            title="Select A Category" data-size="6"  required>
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->cat_id}}" >{{$item->cat_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label >
                                                Title
                                            </label>
                                           <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <hr>
                                <div class="row">
                                  
                                    <div class="col-md-4">
                                        <label >Order By</label>
                                        <select name="orderby" id="orderby" class="form-control" required>
                                            @foreach ($columns as $item)
                                                <option value="{{$item}}" >{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label >Order </label>
                                        <select name="order" id="order" class="form-control" required>
                                            <option value="0" >Asc</option>
                                            <option value="1" >Desc</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label >No of Displayed Product</label>
                                        <input value="8" min="1" type="number" name="count" id="count" class="form-control" required>
                                    </div>
                                
                                </div>
                                <hr>
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <label ><input type="checkbox" name="hasquery" id="hasquery" value="1"> Custom Query</label>
                                        <textarea name="mquery" id="query" cols="30" rows="10" style="width:100%;"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <h5><strong>No Of Shown Item In </strong></h5>
                                            <div class="row">
                                                <div class="col-md-3">
                            
                                                    <label >mobile</label>
                                                    <input type="number" name="mobile" value="1"  min="1" required class="form-control">
                                                </div>
                                                <div class="col-md-3">
                            
                                                    <label >tab</label>
                                                    <input type="number" name="tab" min="1" value="2" required class="form-control">
                                                </div>
                                                <div class="col-md-3">
                            
                                                    <label >laptop</label>
                                                    <input type="number" name="laptop" min="1" value="4"  required class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label >tv</label>
                                                    <input type="number" name="tv" min="1" value="5"  required class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-12">
                                        <input type="submit" value="Add New Section" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                            </div>
                            <br>
                            @foreach ($data->items as $item)
                            
                            <div id="list" style="padding:20px;border: #f1f1f1 1px solid;border-radius:10px;">
                                @include('admin.elements.boxeddisplayitem',$item)
                            </div>
                            <br>
                            @endforeach
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>


    <!--Add Tag  Modal -->
    @include('admin.elements.section')
@endsection

@section('scripts')

@endsection
