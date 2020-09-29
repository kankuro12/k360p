@extends('layouts.sellerlayouts.seller-design')
@section('content')
    <style>
        .card-alert {

            background-color: #f55a4e;
            color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4)
        }

        .text-white {
            color: #ffffff;
        }

    </style>
    @if ($data->verified == 0)
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


    
@endsection
