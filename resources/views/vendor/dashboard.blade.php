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

    @php
        
        
    @endphp
    <?php $messages = \App\VendorMessage::where('vendor_id', $data->id)
    ->where('seen', 0)
    ->get(); ?>
    @foreach ($messages as $message)
        <div class="card card-info" style="padding:2rem 1rem 1rem 2rem;margin:5px;">
            {{ $message->message }}
            <p>
                <form action="{{route('vendor.markread-message',['message'=>$message->id])}}" method="post">
                @csrf
                <input type="submit" value="Mark As Read" style="color:white;text-decoration: underline;border:none;background:transparent;">
                </form>
            </p>
        </div>
    @endforeach

@endsection
