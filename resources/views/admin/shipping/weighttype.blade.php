@extends('layouts.adminlayouts.admin-design')
@section('content')
    @php
    $sel=0;
    if(session('sel')){
    $sel=session('sel');
    }
    @endphp
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
                        <h4 class="card-title">
                            <a href="{{ route('admin.shippings') }}"> <strong>Shippings</strong> </a>
                            /
                            {{ $shipping->name }}
                            /
                            <a href="{{ route('admin.manage-category') }}"> <strong>Categories</strong> </a> 
                            /
                            {{ $category->cat_name }}
                        </h4>
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="content-view">
                            <div class="nav-center">
                                <ul class="nav nav-pills nav-pills-primary nav-pills-icons" role="tablist">
                                    <?php $i = 0; ?>
                                    @foreach (\App\Setting\VendorOption::deliverrange as $range)

                                        <li class="{{ $i == $sel ? 'active' : '' }}">
                                            <a href="#area_{{ $i }}" role="tab" data-toggle="tab" aria-expanded="true">
                                                {{ $range }}
                                            </a>
                                        </li>
                                        <?php $i += 1; ?>
                                    @endforeach
                                    <?php $i = 0; ?>

                                </ul>
                            </div>
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (\App\Setting\VendorOption::deliverrange as $range)
                                    <div class="tab-pane {{ $i == $sel ? 'active' : '' }}" id="area_{{ $i }}"
                                        style="min-height: 40vh;">
                                        <form action="{{ route('admin.shipping-weight') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="deliver_range" value="{{ $i }}">
                                                <input type="hidden" name="category_id" value="{{ $category->cat_id }}">
                                                <input type="hidden" name="shipping_class_id" value="{{ $shipping->id }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <select required class="selectpicker" data-live-search="true"
                                                            id="p_{{ $i }}" name="type" data-style="btn btn-primary"
                                                            title="Select A price Type" data-size="6">
                                                            @foreach (\App\Setting\VendorOption::shippingoption as $key => $item)
                                                                <option value="{{ $key }}">{{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label for="amount">Price</label>
                                                        <input required placeholder="Enter Price" type="number"
                                                            name="amount" id="amount" class="form-control" step="0.01">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label required for="min">Minimum Weight</label>
                                                        <input placeholder="Enter Minimim Weight" type="number" name="min"
                                                            id="min" class="form-control" step="0.01" min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label required for="max">Minimum Weight</label>
                                                        <input type="number" placeholder="Enter Maximum Weight" name="max"
                                                            id="max" class="form-control" step="0.01" min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="submit" value="Save Weight" class="btn btn-primary">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th></th>
                                                    <th class="th-description">Weight Class</th>
                                                    <th>Type</th>
                                                    <th>Price</th>
                                                    <th colspan="2">Actions</th>
                                                </tr>
                                                @foreach (\App\WeightClass::where('category_id', $category->cat_id)->where('deliver_range', $i)->where('shipping_class_id', $shipping->id)->orderBy('min', 'asc')->get()  as $wc)
                                                    <tr>
                                                        <form action="{{ route('admin.shipping-weight-update', ['wc' => $wc->id]) }}" method="post">
                                                        <td></td>
                                                        @csrf
                                                        <td class="td-name">
                                                            <input type="number" name="min" id="min" required step="0.01"
                                                                value="{{ $wc->min }}" style="width:100px;">
                                                            {{ $shipping->weightclass }} -
                                                            <input type="number" name="max" id="max" required step="0.01"
                                                                value="{{ $wc->max }}" style="width:100px;">
                                                            {{ $shipping->weightclass }}</td>
                                                        <td>
                                                            <select required name="type" >
                                                                @foreach (\App\Setting\VendorOption::shippingoption as $key => $item)
                                                                    <option value="{{ $key }}" {{$key==$wc->type?"selected":""}}>{{ $item }}</option>
                                                                @endforeach
                                                            </select>
                                                            {{-- {{ \App\Setting\VendorOption::shippingoption[$wc->type] }} --}}
                                                        </td>
                                                        <td>
                                                            <input type="number" name="amount" id="amount" required step="0.01"
                                                                value="{{ $wc->amount }}" style="width:100px;">
                                                            
                                                            </td>
                                                            <td>
                                                                <input type="submit" value="Update" class="btn btn-primary">
                                                            </td>
                                                        </form>
                                                        <td>
                                                            <form action="{{route('admin.shipping-weight-del',['wc' => $wc->id])}}" method="post">
                                                                @csrf
                                                                 <input type="submit" value="Delete" class="btn btn-danger">
 
                                                             </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    <?php $i += 1; ?>
                                @endforeach
                                <?php $i = 0; ?>
                                <br>

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
    <script>


    </script>
@endsection
