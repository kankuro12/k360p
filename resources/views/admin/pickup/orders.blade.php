@php
$all=$status==3?$point->undelivered():$point->delivered();

@endphp

<div class="">
    <div id="orders">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <strong>
                        {{ App\Setting\OrderManager::stages[$status] }} Orders
                    </strong>
                </h4>

            </div>
            <div class="card-content">
                <div class="content-view">

                    <div style="margin: 1.5rem 0rem;">
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    <strong>

                                        Product Search
                                    </strong>
                                    <br>
                                </label>
                                <input type="text" id="searchinput" class="form-control" onkeyup="myFunction()"
                                    placeholder="Search using Product">
                            </div>
                        </div>
                    </div>

                    <style>
                        #ordertable>tbody>tr>td {
                            padding: 10px 0;
                            border-bottom: 1px solid #f1f1f1;
                        }

                        #ordertable>tbody>tr>th {
                            padding: 10px 0;
                            border-bottom: 1px solid #f1f1f1;
                        }

                        .mintable {
                            width: 100%;
                        }

                        .mintable>tbody>tr>td {
                            padding: 10px 0;
                            border-bottom: 1px solid #f1f1f1;
                        }

                        .mintable>tbody>tr>th {
                            padding: 10px 0;
                            border-bottom: 1px solid #f1f1f1;
                        }

                    </style>
                    <div class="table-responsive">

                        <table id="ordertable" style="width: 100%;">
                            <tr>
                                <th>SID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($all as $data)
                                @include('admin.order.ordergroup',['data'=>$data,'i'=>$i])
                                @php
                                $i+=1;
                                @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($all as $data)
    @php
    $shipping=$data['shipping'];
    @endphp
    <div class="modal fade bd-example-modal-lg" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
        id="order-modal-{{ $shipping->id }}" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="
                font-size: 21px;">&times;</button>
                    <h4 class="modal-title"><strong>Shipping Group -
                            #{{ $shipping->id }}</strong></h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="mintable">
                            <tr>
                                <td>
                                    {{ $shipping->name }}
                                    <br>
                                    <strong style="color:#0acf21;">
                                        {{ $shipping->created_at->diffForHumans() }}
                                    </strong>
                                </td>
                                <td>
                                    {{ $shipping->area->name }},<br>
                                    {{ $shipping->municipality->name }},<br>
                                    {{ $shipping->district->name }},
                                    {{ $shipping->province->name }}
                                </td>
                                <td>
                                    {{ $shipping->email }}
                                </td>
                                <td>
                                    {{ $shipping->phone }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @foreach ($data['items'] as $order)
                    <div>
                        @include('admin.pickup.singleorder',['order'=>$order,'sid'=>$shipping->id])
                    </div>
                @endforeach

                <div>

                </div>

            </div>
        </div>
    </div>
@endforeach
