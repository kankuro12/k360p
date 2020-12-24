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
                        $category_id=0;
                        $orderby="";
                        $order=0;
                        $count=8;
                        $mobile=1;
                        $tab=2;
                        $laptop=3;
                        $tv=5;
                        $showtitle=false;
                        if($data!=null){
                            $category_id=$data->category_id;
                            $orderby=$data->orderby;
                            $order=$data->order;
                            $count=$data->count;
                            $mobile=$data->mobile;
                            $laptop=$data->laptop;
                            $tab=$data->tab;
                            $tv=$data->tv;
                            $showtitle=$data->showtitle==1;
                        }
                        @endphp
                        <h4 class="card-title"> <a href="{{ route('elements') }}"><strong>Homepage Section</strong></a>/
                            Category Display / <strong>{{ $section->name }}</strong></h4>
                        <div>

                        </div>
                        <div class="content-view">
                            <div id="root">
                                <form enctype="multipart/form-data" action="{{ route('elements.save-category', ['section' => $section->id]) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label >Category</label>
                                            <select name="category_id" id="category_id" class="selectpicker " data-live-search="true"  data-style="btn btn-primary"
                                            title="Select A Category" data-size="6"  required>
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->cat_id}}" {{$category_id==$item->cat_id?"selected":""}}>{{$item->cat_name}}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-4">
                                            <label >Order By</label>
                                            <select name="orderby" id="orderby" class="form-control" required>
                                                @foreach ($columns as $item)
                                                    <option value="{{$item}}" {{$orderby==$item?"selected":""}}>{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label >Order </label>
                                            <select name="order" id="order" class="form-control" required>
                                                <option value="0" {{$order==0?"selected":""}}>Asc</option>
                                                <option value="1" {{$order==1?"selected":""}}>Desc</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label >No of Displayed Product</label>
                                            <input value="{{$count}}" min="1" type="number" name="count" id="count" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input value="1" type="checkbox" name="showtitle" id="showtitle" {{$showtitle?"checked":""}}> Show Title
                                        </div>

                                    </div>
                                    <div>
                                        <h5><strong>No Of Shown Item In </strong></h5>
                                        <div class="row">
                                            <div class="col-md-3">

                                                <label >mobile</label>
                                                <input type="number" name="mobile" value="{{$mobile}}"  min="1" step="0.001" required class="form-control">
                                            </div>
                                            <div class="col-md-3">

                                                <label >tab</label>
                                                <input type="number" name="tab" min="1" value="{{$tab}}" step="0.001" required class="form-control">
                                            </div>
                                            <div class="col-md-3">

                                                <label >laptop</label>
                                                <input type="number" name="laptop" min="1" value="{{$laptop}}" step="0.001"  required class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label >tv</label>
                                                <input type="number" name="tv" min="1" value="{{$tv}}"  required class="form-control">
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
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>



@endsection

@section('scripts')
<script>

</script>
@endsection
