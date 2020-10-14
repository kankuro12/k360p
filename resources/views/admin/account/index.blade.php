@extends('layouts.adminlayouts.admin-design')

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
                            Finance
                        </h4>
                        <div class="content-view">
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Vendor ID</th>
                                            <th class="text-left">Owner Name</th>
                                            <th class="text-left">Store Name</th>
                                            <th class="text-left">Total </th>
                                            <th class="text-left">Withdrawable</th>
                                            <th class="disabled-sorting text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $vendor)
                                            @php
                                            $account =$vendor->account();
                                            @endphp
                                            <tr>
                                                <td>
                                                    #{{ $vendor->id }}
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('admin.vendor-details', ['id' => $vendor->user->id]) }}">
                                                        {{ $vendor->name }} </a>
                                                </td>
                                                <td>
                                                    {{ $vendor->storename }}
                                                </td>
                                                <td>
                                                    {{ $account->total() }}
                                                </td>
                                                <td>
                                                    {{ $account->withdraw() }}
                                                </td>
                                                <td>
                                                    @if ($account->total() >= env('minwithdrawl', 100))
                                                        @if (env('paymentstyle', 0) == 0){
                                                            <a class="btn btn-primary"
                                                                href="{{ route('admin.withdrawl', ['id' => $vendor->id]) }}">Withdrawl</a>
                                                        @endif
                                                    @endif
                                                    <a class="btn btn-success"
                                                        href="{{ route('admin.detail', ['id' => $vendor->id]) }}">Details</a>
                                                    {{-- <a
                                                        href="{{ route('admin.withdrawl', ['id' => $vendor->id]) }}">Withdrawl</a>
                                                    --}}
                                                </td>
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
