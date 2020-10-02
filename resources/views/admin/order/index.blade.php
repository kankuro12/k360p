@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 vendordetails">
                <h3 class="text-center" style="margin-top: 0px;">Store Order</h3>
                <br>
                <div class="nav-center">
                    <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                        @php
                        $i=0;
                        @endphp
                        @foreach ($stages as $stage)

                            <li class="{{ $i == $status ? 'active' : '' }}">
                                <a href="{{ route('admin.orders', ['status' => $i]) }}" aria-expanded="true">
                                    <i class="material-icons">{{ App\Setting\OrderManager::stageicons[$i] }}</i>{{ $stage }}
                                </a>
                            </li>
                            @php
                            $i+=1;
                            @endphp
                        @endforeach

                    </ul>
                </div>
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
                                    <div class="table-responsive">

                                        <table class="table">
                                            <tr>
                                                <th>SN</th>
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

            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- Edit Attribute Modal -->


@endsection
@section('scripts')
    <script>

    </script>
@endsection
