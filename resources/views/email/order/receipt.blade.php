<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'laravel') }}</title>
    <style>
        .container {
            margin: 0 2rem;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        #orders {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #orders td,
        #orders th {
            border: 1px solid #ddd;
            padding: 8px;
        }




        #orders th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        .td-1 {
            width: 25%;
        }

        .td-2 {
            width: 75%;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
        }

        p {
            margin: 0.3rem 0rem;
        }

    </style>
</head>

<body>
    @php
        $total=0;
    @endphp
    <div class="container">
        <h1 class="text-center" style="margin-bottom: 5px;">
            <img src="{{ asset('logo.png') }}" style="max-width:200px;">
        </h1>
        <hr>
        <h1 style="font-weight: 600;color:#626871;text-align: center;">
            <strong>Thank You For Your Order</strong>
        </h1>
        <br>


        <div style="background-color: #EBF8F3;min-height:100px;text-align:center;padding:0.5rem;">
            <h3 style="border-bottom:1px #ffffff solid; padding:0.1rem 0rem;">

                <strong>
                    Order Confirmation
                </strong>
            </h3>
            <div style="text-align: left">

                <h3 style="border-bottom:1px #ffffff solid; padding:0.1rem 0rem;">
                    <strong>Customer Details</strong>
                </h3>
                <p>
                    <strong>Order Group ID: </strong>#{{ $shipping->id }}
                </p>
                <p>
                    <strong>Name: </strong>{{ $shipping->name }}
                </p>
                
                <p>
                    <strong>Address: </strong>{{$shipping->streetaddress}}
                    @if ( $shipping->shipping_area_id!=null)
                        
                    {{ $shipping->area->name }}, {{ $shipping->municipality->name }},
                    {{ $shipping->district->name }}, {{ $shipping->province->name }}
                    @endif
                </p>
                <p>
                    <strong>Email: </strong>{{ $shipping->email }}
                </p>
                <p>
                    <strong>Phone: </strong>{{ $shipping->phone }}
                </p>
                <p>
                    <strong>OTP: </strong>{{ $shipping->otp }}
                </p>

            </div>
        </div>
        <br>
        @php
            $total=0;
        @endphp
        <div style="background-color: #FFEEEE;">
            <table id="orders">
                @foreach ($orders as $order)
                    @php
                    $product=$order->product;
                    @endphp
                    <tr>
                        <td class="td-1" width="200">
                            <div style="max-width:200px">

                                <img src="{{ asset($product->product_images) }}" style="width:200px;">
                            </div>
                        </td>
                        <td class="td-2" >
                            <div>
                                <h3>Order Details</h3>

                                <p>
                                    <strong>Order Track ID: </strong>#{{ $order->id }}
                                </p>
                                <p>
                                    <strong>Name: </strong>{{ $product->product_name }}
                                </p>
                                <p>
                                    <strong>Quantity: </strong>{{ $order->qty }}
                                </p>
                                <p>
                                    <strong>Rate: </strong>{{ $order->rate }}
                                </p>
                                <p>
                                   
                                </p>
                                <p>
                                    <strong>Delivery: </strong>{{\App\Setting\OrderManager::delivertype[ $order->deliverytype] }} Delivery
                                </p>
                                @if ($order->variant_code!=null)
                                    
                                <p>
                                    <strong>Options: </strong>{{$order->variant()}}
                                </p>
                                @endif
                                <hr>

                                @php
                                    $subtotal=($order->rate*$order->qty)
                                @endphp

                                <h3>Extra Charges</h3>
                                @foreach ($order->charges as $charge)
                                       <strong> {{$charge->title}} </strong>- {{$charge->amount}}  
                                       @php
                                       $subtotal+=$charge->amount;
                                   @endphp  
                                @endforeach
                                <hr>
                                <h3>
                                    <strong> Subtotal : </strong> {{$subtotal}}
                                    @php
                                        $total+=$subtotal;
                                    @endphp
                                </h3>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
<br>
<div style="text-align:right">
    <strong>Total:</strong>{{$total}} <br>
    <strong>shipping charge:</strong>{{$shipping->shipping_charge}} <br>
    <strong>Grand Total:</strong>{{$total+$shipping->shipping_charge}} <br>
</div>
        <div style="background-color:#F2DEDE;text-align:center;padding: 2rem 0.5rem;">
            <a style="border:none;background:#007ACC;color:white;padding:0.9rem 2rem;font-weight:800;text-decoration: none;" href="{{route('user.account')}}" target="_blank">
                View You Account
            </a>
        </div>
        <br>
        <div style="background-color:#007ACC;text-align:center;padding: 2rem 0.5rem;color:white;">
            <h1>{{env('APP_NAME','LARAVEL')}}</h1>
            <h4>
                {{env('st_add','street address')}},<br>
                {{env('district','district')}},  {{env('province','province')}}
            </h4>
            <h4>Phone, Email</h4>
            <p>
                <span style="color:white">
                    <a href="{{env('facebook','#')}}">
                        @include('email.order.facebook')
                    </a>
                </span>
                <span style="color:white">
                    <a href="{{env('insta','#')}}">
                        @include('email.order.instagram')
                    </a>
                </span>
            </p>
        </div>
    </div>
</body>

</html>
