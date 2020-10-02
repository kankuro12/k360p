@extends('layouts.sellerlayouts.seller-design')
@section('content')
    <style>
        .card-alert {

            background-color: #f55a4e;
            color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4)
        }

        .card-info {
            background-color: #00bcd4;
            color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4);
        }

        .text-white {
            color: #ffffff;
        }

    </style>

    @if ($data->verified == 0)
        @php
            $verification=\App\VendorVerification::where('vendor_id', $data->id)->first();
        @endphp
        @if ($verification==null)
        <div class="row">
            <div class="col-md-12">
                <div class="card card-alert">
                    <div class="card-header color-white">
                        <h4 class="card-title">
                            <strong class="text-white">
                                Verification Detail Not Found.
                            </strong>
                        </h4>

                    </div>
                    <div class="card-header">
                        <a href="{{route('vendor.verification')}}">Click Here To Add Verification Details..</a>
                    </div>
                    <br>
                </div>


            </div>


        </div>
        <br>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-alert">
                    <div class="card-header color-white">
                        <h4 class="card-title">
                            <strong class="text-white">
                                Account Not Verified
                            </strong>
                        </h4>

                    </div>
                    <div class="card-header">
                        the message
                    </div>
                    <br>
                </div>


            </div>


        </div>

    @endif

    @if ($data->islaunched==0)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-alert">
                <div class="card-header color-white">
                    <h4 class="card-title">
                        <strong class="text-white">
                            You store is in Draft Mode. Publish you Store to Make it visible to customers.
                        </strong>
                    </h4>

                </div>
                <div class="card-header">
                    <a href="{{route('vendor.launch')}}">Click Here To Publish Your Store</a>
                </div>
                <br>
            </div>


        </div>


    </div>
    @endif
    

@endsection
