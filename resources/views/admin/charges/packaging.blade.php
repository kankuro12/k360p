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
                        <i class="material-icons">card_giftcard
                        </i>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">
                            Packaging Charges
                        </h4>
                        
                    </div>
                    <div class="card-content">
                        <br>
                        <form action="{{route('admin.packaging-add')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label >Packaging Name</label>
                                    <input required type="text" name="name" id="name" 
                            class="form-control" placeholder="Enter Package name">
                                </div>
                                
                                <div class="col-md-6">
                                    <label >Rate</label>
                                    <input  required  type="number" step="0.01" min="0" name="amount" id="amount" 
                            class="form-control" placeholder="Enter Rate">
                                </div>
                                
                                <div class="col-md-6">
                                    <input type="submit" value="Add New" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h4>
                            <strong>Packaging Charges</strong>
                        </h4>
                        <table class="table">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Rate</th>
                             
                                <th colspan="2"></th>
                            </tr>
                            @foreach (\App\PackagingCharge::all() as $packaging)
                            <tr>
                                <form action="{{route('admin.packaging-update',['packaging'=>$packaging->id])}}" method="post">
                                @csrf
                                    <td></td>
                                <td>  <input required type="text"  name="name" id="name" 
                                    class="form-control" placeholder="Enter Name" value="{{$packaging->name}}"></td>
                              
                                <td> <input  required  type="number" step="0.01" min="0" name="amount" id="amount" 
                                    class="form-control" placeholder="Enter Rate" value="{{$packaging->amount}}"></td>
                                <td >
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </td>
                                </form>
                                <td >
                                    <form action="{{route('admin.packaging-del',['packaging'=>$packaging->id])}}" method="post">
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