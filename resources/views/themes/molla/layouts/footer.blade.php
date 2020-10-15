<footer class="footer">
    <div class="cta cta-horizontal cta-horizontal-box bg-dark bg-image" style="background-image: url('assets/images/demos/demo-14/bg-1.jpg');">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-8 offset-xl-2">
                    <div class="row align-items-center">
                        <div class="col-lg-5 cta-txt">
                            <h3 class="cta-title text-primary">Join Our Newsletter</h3><!-- End .cta-title -->
                            <p class="cta-desc text-light">Subcribe to get information about products and coupons</p><!-- End .cta-desc -->
                        </div><!-- End .col-lg-5 -->
                        
                        <div class="col-lg-7">
                            <form action="#">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">Subscribe</button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                        </div><!-- End .col-lg-7 -->
                    </div><!-- End .row -->
                </div><!-- End .col-xl-8 offset-2 -->
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .cta -->
    <div class="footer-middle border-0 fsem">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="widget widget-about">
                        <img src="{{asset('logo.png')}}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                        @php
                            $about=\App\AboutUs::first();
                        @endphp
                        <p class="min-about">{!! $about!=null?$about->mini:""!!}</p>
                        
                        <div class="widget-about-info">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <span class="widget-about-title">Got Question? Call us 24/7</span>
                                    <a href="tel:{{env('phone','')}}" class="footer-tel">{{env('phone','')}}</a>
                                </div><!-- End .col-sm-6 -->
                                {{-- <div class="col-sm-6 col-md-8">
                                    <span class="widget-about-title">Payment Method</span>
                                    <figure class="footer-payments">
                                       
                                    </figure><!-- End .footer-payments -->
                                </div><!-- End .col-sm-6 --> --}}
                            </div><!-- End .row -->
                        </div><!-- End .widget-about-info -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-12 col-lg-4 -->

                @foreach(\App\Footerhead::all() as $h)
                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">{{ $h->title }}</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            @foreach($h->link as $l)
                              <li><a href="{{ $l->link }}">{{ $l->title }}</a></li>
                            @endforeach
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-4 col-lg-2 -->
                @endforeach

                

               

                
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container-fluid">
            <p class="footer-copyright">Copyright © 2020 {{env('APP_NAME',"your")}} All Rights Reserved.</p><!-- End .footer-copyright -->
            <div class="social-icons social-icons-color">
                <span class="social-label">Social Media</span>
                <a href="{{env('fb','#')}}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="{{env('twitter','#')}}" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                <a href="{{env('insta','#')}}" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                <a href="{{env('youtube','#')}}" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                <a href="{{env('pinintrest','#')}}" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                <a href="{{env('linkedin','#')}}" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
            </div><!-- End .soial-icons -->
        </div><!-- End .container-fluid -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->