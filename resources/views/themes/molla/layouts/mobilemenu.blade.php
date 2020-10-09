<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="{{ url('/')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('shops')}}" class="sf-with">Shop</a>
                        </li>
                        <li>
                            <a href="{{ url('collection-product') }}" class="sf-with">Our Collection</a>
                        </li>

                        <li>
                            <a href="{{ url('sale-product') }}" class="sf-with">Buy Cheaper</a>
                        </li>

                        <li>
                            <a href="#" class="sf-with">About Us</a>
                        </li>

                        <li>
                            <a href="#" class="sf-with">Contact Us</a>
                        </li>
                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                    @foreach ($cats as $item)
                        <li><a class="mobile-cats-lead" href="{{ url('shop-by-category/'.$item->id)}}">{{ $item->cat_name }}</a></li>
                        @if (count($item->subcat))
                          @foreach ($item->subcat as $item1)
                            <li><a href="{{ url('shop-by-category/'.$item1->id)}}">-{{ $item1->cat_name }}</a></li>
                            @if (count($item1->subcat))
                                @foreach ($item1->subcat as $i)
                                 <li><a href="{{ url('shop-by-category/'.$i->id)}}">--{{ $i->cat_name }}</a></li>
                                @endforeach
                            @endif
                          @endforeach
                        @endif
                    @endforeach
                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->