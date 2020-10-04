@extends('layouts.adminlayouts.admin-design')
@section('content')
@php
    $sel=1;
    if(session('sel')){
        $sel=session('sel');
    }
@endphp
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">monetization_on</i>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">
                            <a href="{{ route('admin.manage-category') }}"> <strong>Categories</strong> </a> 
                            /
                            {{ $category->cat_name }}
                            /
                            Closing Charges
                        </h4>
                        
                    </div>
                    <div class="card-content">
                        <br>
                        <form action="{{route('admin.closingcharges-add',['category'=>$category->cat_id])}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label >Lower value</label>
                                    <input required type="number" step="0.01" min="0" name="min" id="min" 
                            class="form-control" placeholder="Enter Lower Value">
                                </div>
                                <div class="col-md-6">
                                    <label >Upper value</label>
                                    <input required  type="number" step="0.01" min="0" name="max" id="max" 
                            class="form-control" placeholder="Enter Upper Value">
                                </div>
                                <div class="col-md-6">
                                    <label >Rate</label>
                                    <input  required  type="number" step="0.01" min="0" name="amount" id="amount" 
                            class="form-control" placeholder="Enter Rate">
                                </div>
                                <div class="col-md-6">
                                    <label >Rate Type</label>
                                    <select required  name="type" id="type" class="form-control">
                                        <option></option>
                                        <option value="0">Flat Rate</option>
                                        <option value="1">Percentage Rate</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Add New" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
    <hr>
    <h4>
        <strong>Closing Charges</strong>
    </h4>
                        <table class="table">
                            <tr>
                                <th></th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Type</th>
                                <th>Rate</th>
                                <th colspan="2"></th>
                            </tr>
                            @foreach ($category->closingCharges as $closingcharge)
                            <tr>
                                <form action="{{route('admin.closingcharges-update',['charge'=>$closingcharge->id])}}" method="post">
                                @csrf
                                    <td></td>
                                <td>  <input required type="number" step="0.01" min="0" name="min" id="min" 
                                    class="form-control" placeholder="Enter Name" value="{{$closingcharge->min}}"></td>
                                <td> <input required type="number" step="0.01" min="0" name="max" id="max" 
                                    class="form-control" placeholder="Enter Name" value="{{$closingcharge->max}}"></td>
                                <td> <select required  name="type" id="type" class="form-control">
                                    <option></option>
                                    <option value="0" {{$closingcharge->type==0?"selected":""}}>Flat Rate</option>
                                    <option value="1" {{$closingcharge->type==1?"selected":""}}>Percentage Rate</option>
                                </select></td>
                                <td> <input  required  type="number" step="0.01" min="0" name="amount" id="amount" 
                                    class="form-control" placeholder="Enter Rate" value="{{$closingcharge->amount}}"></td>
                                <td >
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </td>
                                </form>
                                <td >
                                    <form action="{{route('admin.closingcharges-del',['charge'=>$closingcharge->id])}}" method="post">
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-danger">

                            </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


@endsection 
@section('scripts')
    
@endsection