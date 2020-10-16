<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME','')}}</title>
</head>
<body>
    
    <style>
        .header{
            text-align: center;margin:0;
        }

        .table{
            width:100%;
        }
        
        .w-25{
            width:25%;
        }
        .t_r{
            text-align: right;
        }
        .t_l{
            text-align: left;
        }

        .tt th{
            border: 1px dotted black;
        }
        .tt td{
            border: 1px dotted black;
        }

        .tp {
            border-collapse: collapse;
            border: 1px solid black;
            text-align: center;
            }

            .tp th,.tp td {
            border: 1px solid black;
            }

            @media print {
                .footer { break-after: page;}
            }
    </style>
   
   @foreach ($all as $item)   
        <h2 class="header">
            {{env('billingname','')}}
        </h2>
        <h4 class="header">
            {{env('address','munalpath biratnagar')}}
        </h4>
        <h4 class="header">
            {{env('phone','9800000000')}}
        </h4>
        <br>
        <div>
            <table class="table tt">
                <tr>
                    <th class="t_r w-25">
                        Shipping ID:
                    </th>
                    <td class="t_l w-25">
                        #{{$item['shipping']->id}}
                    </td>
                    <th class="t_r w-25">
                      Purchase Date:
                    </th>
                    <td class="t_l w-25">
                        {{$item['shipping']->created_at->toDateString()}}
                    </td>
                </tr>
                    @php
                        $shipping=$item['shipping'];
                    @endphp
                <tr>
                    <th class="t_r w-25">
                        Billed To:
                    </th>
                    <td class="t_l w-25">
                        {{ $shipping->name}}
                    </td>
                    <th class="t_r w-25">
                      Address:
                    </th>
                    <td class="t_l w-25">
                        {{ $shipping->area->name }}, {{ $shipping->municipality->name }},
                        {{ $shipping->district->name }}, {{ $shipping->province->name }}
                    </td>
                </tr>

                <tr>
                    <th class="t_r w-25">
                        Email:
                    </th>
                    <td class="t_l w-25">
                        {{ $shipping->email}}
                    </td>
                    <th class="t_r w-25">
                      phone:
                    </th>
                    <td class="t_l w-25">
                        {{ $shipping->phone }}
                    </td>
                </tr>

            </table>
        </div>
        <hr>
        @php
            $total=0;
        @endphp
        <table class="table tp">
            <tr>
                <th>Order ID#</th>
                <th>Product NAme</th>
                <th>Rate(RS)</th>
                <th>Qty</th>
                {{-- <th>Shipping(RS)</th> --}}
                <th>Extra(RS)</th>
                <th>Sub Total(RS)</th>
            </tr>

            @foreach ($item['orders'] as $order) 
        
                <tr>
                    <td>
                        #{{$order->id}}
                    </td>
                    <td>
                        {{$order->product->product_name}}
                    </td>
                    <td>
                        {{$order->rate}}
                    </td>
                    <td>
                        {{$order->qty}}
                    </td>
                    {{-- <td>
                        {{$order->shippingcharge}}
                    </td> --}}
                    <td>
                        {{$order->extraCharges()}}
                    </td>
                    <td class="t_l">
                        @php
                            $subtotal=($order->rate*$order->qty)+$order->extraCharges();
                            $total+=$subtotal;
                       @endphp
                        {{$subtotal}}
                    </td>
                </tr>
            @endforeach
            <tr>
                <th class="t_r" colspan="5">
                    Total:
                </th>
                <td class="t_l">
                    {{$total}}
                </td>
            </tr>
            <tr>
                <th class="t_r" colspan="5">
                    Shipping Charge:
                </th>
                <td class="t_l">
                    {{$shipping->shipping_charge}}
                </td>
            </tr>
            <tr>
                <th class="t_r" colspan="5">
                    Grand Total:
                </th>
                <td class="t_l">
                    {{$shipping->shipping_charge+$total}}
                </td>
            </tr>
        </table>
        <div class="footer">
            <h5 style="text-align: center;">Thank you for using {{env('APP_NAME','LARAVEL')}}. Have A nice Day!!</h5>
        </div>
   @endforeach
</body>
</html>