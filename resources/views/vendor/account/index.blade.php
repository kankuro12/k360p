@extends('layouts.sellerlayouts.seller-design')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
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
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">
                            <strong>
                                <a href="{{route('admin.account')}}">Finance</a>
                            </strong> /
                           
                            Details
                        </h4>
                        <div class="content-view">
                            <div class="material-datatables">
                                <table  class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Vendor ID</th>
                                            <th class="text-left">Owner Name</th>
                                            <th class="text-left">Store Name</th>
                                            <th class="text-left">Total </th>
                                            <th class="text-left">Withdrawable</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                           @php
                                               $vendor =$account->vendor;
                                           @endphp
                                            <tr>
                                                <td>
                                                    #{{$vendor->id}}
                                                </td>
                                                <td>
                                                   <a href="{{route('vendor.edit-profile',['id'=>$vendor->user->id])}}"> {{$vendor->name}} </a>
                                                </td>
                                                <td>
                                                    {{$vendor->storename}}
                                                </td>
                                                <td>
                                                    {{$account->total()}}
                                                </td>
                                                <td>
                                                    {{$account->withdraw()}}
                                                </td>
                                               
                                            </tr>
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">
                            Withdrawls
                        </h4>
                        
                        <div class="content-view">
                            
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Transaction ID</th>
                                            <th class="text-left">Image</th>
                                            <th class="text-left">Details</th>
                                            <th class="text-left">Amount (RS)</th>
                                            <th class="text-left">Date</th>
                                            
                                            {{-- <th class="disabled-sorting text-left">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($account->withdrawls() as $withdrawl)
                                          
                                            <tr>
                                                <td>
                                                    #{{$withdrawl->id}}
                                                </td>
                                                <td>
                                                    <a href="{{asset($withdrawl->image)}}" target="_blank">
                                                        <img style="max-width:200px;" src=" {{asset($withdrawl->image)}}" alt="" srcset="">
                                                    </a>
                                                </td>
                                                <td>
                                                    @foreach ($attributes as $attr)
                                                        <div>
                                                            <strong>
                                                                {{$attr}}:
                                                            </strong>
                                                            {{$withdrawl->paymentdetails[$attr]}}
                                                          
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>{{$withdrawl->amount}}</td>
                                                <td>{{$withdrawl->completeddate}}</td>
                                                {{-- <td></td> --}}
                                            </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
