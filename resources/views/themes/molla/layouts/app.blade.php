<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}} @yield('title')</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="NeedCommerce">
    <meta name="author" content="Need Technosoft">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">

    <meta name="apple-mobile-web-app-title" content="{{env('APP_NAME')}}">
    <meta name="application-name" content="{{env('APP_NAME')}}">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    @yield('meta')

    {!! \App\Setting\HomePage::renderCSS()!!}
    @yield('css')

    <style>
        
        
    </style>
</head>
@php
   $cats = \App\model\admin\Category::with('subcat')->where('parent_id',null)->get();
@endphp

<body>
    <div class="page-wrapper">
        @include('themes.molla.layouts.customcss')

        @include('themes.molla.layouts.header')
               
                @yield('contant')
       
    </div><!-- End .page-wrapper -->

    <style>
        #scroll-top{
            width:40px;
            height: 40px;
            border-radius: 50%;
            background-color: #999;
            color:#fff;
            font-size: medium;
            right: 10px;
            bottom: 95px;
        }

        #social-up-icon{
            width:40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background-color: #999;
            color:#fff;
            font-size: medium;
            right: 10px;
            bottom: 140px;
            position: fixed;
            z-index: 999;
        }
        #social-up-icon:hover{
          
            background-color: #FF5C00;
 
        }

        #scroll-top:hover{
            background-color: #FF5C00;
            color:#fff;
            right: 10px;
            bottom: 100px;
        }

        .social-up{
            right: 10px;
            bottom: 180px;
            position: fixed;
            text-align: center;
            right:0;
            z-index: 999;
        }

        .social-up a{
            display: block;
            padding-top:0.5rem;
            background-color: #999;
            color:#fff;
            border:none;
            margin-bottom: 0.1rem;
        }
        
        .social-up a:hover{
            display: block;
            padding-top:0.5rem;
            background-color: #FF5C00;
            transform: scale(1.1);
        }
        
    
    </style>

    <div class="social-up" id="social-up">

                <a href="{{env('fb','#')}}" class="social-icon " title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="{{env('twitter','#')}}" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                <a href="{{env('insta','#')}}" class="social-icon " title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                <a href="{{env('youtube','#')}}" class="social-icon " title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                <a href="{{env('pinintrest','#')}}" class="social-icon " title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                <a href="{{env('linkedin','#')}}" class="social-icon " title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
    </div>

    <button id="social-up-icon" title="Back to Top" onclick="social_toogle()">
        <i class="icon-minus"></i>
    </button>

    <button id="scroll-top" title="Back to Top">
        <i class="icon-angle-up"></i>
    </button>

      <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
    @include('themes.molla.layouts.mobilemenu')
    @include('themes.molla.layouts.footer')
    @yield('popup')

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="{{ route('user.postLogin') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" name="email" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" name="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="{{ route('fpass')}}"  class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center"><a href="{{ route('user.getRegister') }}" >Click Here For Signup</a></p>
                                        
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal --> 

    {!! \App\Setting\HomePage::renderJS()!!}
    
    @yield('js')
    <script>
        function dropclick(p){
            console.log(p);
            console.log($('#cat')[0])
            $('#cat').trigger('mousedown')
            $('#cat').focus();
            $('#cat').click();
        }
        $('#social-up').hide();
        $('#social-up-icon').html(' <i class="icon-plus"></i>')
        var state=1;
        function social_toogle(){
            $('#social-up').toggle('slow');
            if(state==1){
                state=0;
                $('#social-up-icon').html(' <i class="icon-minus"></i>')
            }else{
                state=1;
                $('#social-up-icon').html(' <i class="icon-plus"></i>')

            }
        }
    </script>

</body>



</html>