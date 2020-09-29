<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/backend_images/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/backend_images/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Vendor :: Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/backend-css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/backend-css/material-dashboard.css?v=1.2.1') }}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        #image-preview {
            width: 400px;
            height: 400px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #ecf0f1;
            background-size: cover;
            background-position: center;
        }

        #image-preview input {
            line-height: 200px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }

        #image-preview label {
            position: absolute;
            z-index: 5;
            opacity: 0.8;
            cursor: pointer;
            background-color: #050708;
            width: 50px;
            height: 50px;
            font-size: 20px;
            line-height: 50px;
            text-transform: uppercase;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            text-align: center;
            color: #ffffff;
        }

        .modal-footer .btn+.btn {
            margin-left: 5px;
        }

        #outPopUp {
            position: relative;
            display: inline-block;
            z-index: 15;
            
            margin: 25px 0;
            box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
            border-radius: 6px;
            color: rgba(0, 0, 0, 0.87);
            background: white;
            min-width: 60%;
            min-height: 300px;
        }

        .btn-step {
            width: 100%;
            margin: 0;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .btn-step-disable {
            background: transparent;
            color: #3C4858;
        }

    </style>
</head>

<body style="min-height: 100vh;">
    <div class="container">
        <div id="outPopUp">
            <div class="p-3">
                <h3 class="text-center" style="font-weight: 500;color:#3C4858;">
    
                    Hello {{ Auth::user()->vendor->name }}
                </h3>
                <h4 class="text-center">
                    Let's setup some things before you can start selling.
                </h4>
                <div class="row" style="background: #F4F4F4; margin-right:-10px;margin-left:-10px;">
                    <div class="col-md-4" style="padding:0">
                        <button
                            class="btn {{ Auth::user()->status() == 0 ? 'btn-danger' : 'btn-step-disable' }} btn-step">Account
                            Activation</button>
                    </div>
                    <div class="col-md-4" style="padding:0">
                        <button
                            class="btn btn-step {{ Auth::user()->status() == 1 ? 'btn-danger' : 'btn-step-disable' }}">General
                            info</button>
                    </div>
                    <div class="col-md-4" style="padding:0">
                        <button
                            class="btn btn-step {{ Auth::user()->status() == 2 ? 'btn-danger' : 'btn-step-disable' }} ">Verification
                            Detail</button>
                    </div>
    
                </div>
            </div>
            <div class="p-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="p-3">
                @yield('content')
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->

<script src="{{ asset('js/backend-js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend-js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend-js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend-js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<!-- Library for adding dinamically elements -->
<script src="{{ asset('js/backend-js/arrive.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('js/backend-js/moment.min.js') }}"></script>
<script src="{{ asset('js/backend-js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/backend-js/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('js/backend-js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/backend-js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('js/backend-js/nouislider.min.js') }}"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('js/backend-js/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{ asset('js/backend-js/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="{{ asset('js/backend-js/sweetalert2.js') }}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('js/backend-js/jasny-bootstrap.min.js') }}"></script>
<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('js/backend-js/jquery.tagsinput.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ asset('js/backend-js/material-dashboard.js?v=1.2.1') }}"></script>
<script src="{{ asset('js/backend-js/jquery.uploadPreview.min.js') }}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/backend-js/demo.js') }}"></script>
<script src="{{ asset('js/backend-js/custom.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

</script>
@yield('scripts');

</html>
