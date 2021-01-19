<aside class="sidebar-shop sidebar-filter">
    <form action="">
    <div class="sidebar-filter-wrapper">
        <div class="widget widget-clean">
            <label><i class="icon-close"></i>Filters</label>
            <a href="{{route('shops')}}" >Clean All</a>
        </div><!-- End .widget -->

            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                        Price
                    </a>
                </h3><!-- End .widget-title -->
                @if (isset($_max) && isset($_min))

                <div class="collapse show" id="widget-5">
                    <div class="widget-body">
                        <div class="filter-price">
                            <input type="hidden" name="max" id="max" value="{{$_max}}">
                            <input type="hidden" name="min" id="min" value="{{$_min}}">
                            <div class="filter-price-text">
                                Price Range:
                                <span id="filter-price-range"></span>
                            </div><!-- End .filter-price-text -->

                            <div id="need-price-slider"></div><!-- End #price-slider -->
                        </div><!-- End .filter-price -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
                @endif
            </div><!-- End .widget -->

            <div class="widget widget-collapsible">
                <h3 class="widget-title text-black">
                    <a style="color:black" data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                        Category
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-1">
                    <div class="widget-body">
                        <div class="filter-items filter-items-count">
                            @foreach (\App\model\admin\Category::whereNull('parent_id')->get() as $category)
                                @include(\App\setting\HomePage::theme('product.filter_Category'),['category'=>$category])
                            @endforeach


                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->


        </div><!-- End .sidebar-filter-wrapper -->
                <div>
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Apply Filter" id="">
                </div>
            </form>
</aside><!-- End .sidebar-filter -->
