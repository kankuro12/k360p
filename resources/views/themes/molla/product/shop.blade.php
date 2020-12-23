@extends('themes.molla.layouts.app')
@section('title','Shops')
@section('contant')
@php
    $isgrid=1;


    if(session()->has('isgrid')){
        // dd(session('isgrid'));
        $isgrid=session('isgrid');
    }
@endphp
<main class="main">
        	<div class="page-header text-center" style="background-image: url('themes/molla/assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Product<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container" >
        			<div class="toolbox">
        				<div class="toolbox-left">
                            <a href="#" class="sidebar-toggler"><i class="icon-bars"></i>Filters</a>
        				</div><!-- End .toolbox-left -->

                        <div class="toolbox-center">
                            <div class="toolbox-info">
                                {{-- Showing <span>12 of 56</span> Products --}}
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-center -->

        				<div class="toolbox-right">
        					{{-- <div class="toolbox-sort">
        						<label for="sortby">Sort by:</label>
        						<div class="select-custom">
									<select name="sortby" id="sortby" class="form-control">
										<option value="popularity" selected="selected">Most Popular</option>
										<option value="rating">Most Rated</option>
										<option value="date">Date</option>
									</select>
								</div>
                            </div><!-- End .toolbox-sort --> --}}
                            <div class="toolbox-layout">

                						<a href="{{route('grid',['id'=>0])}}" class="btn-layout {{$isgrid==1?"":"active"}}">
                							<svg width="16" height="10">
                								<rect x="0" y="0" width="4" height="4"></rect>
                								<rect x="6" y="0" width="10" height="4"></rect>
                								<rect x="0" y="6" width="4" height="4"></rect>
                								<rect x="6" y="6" width="10" height="4"></rect>
                							</svg>
                						</a>

                						<a href="{{route('grid',['id'=>1])}}" class="btn-layout {{$isgrid==1?"active":""}}" >
                							<svg width="10" height="10">
                								<rect x="0" y="0" width="4" height="4"></rect>
                								<rect x="6" y="0" width="4" height="4"></rect>
                								<rect x="0" y="6" width="4" height="4"></rect>
                								<rect x="6" y="6" width="4" height="4"></rect>
                							</svg>
                						</a>
                					</div>
        				</div><!-- End .toolbox-right -->
        			</div><!-- End .toolbox -->

                    <div class="products">
                        <div class="row">
                            @foreach($products as $p)
                            @if ($isgrid==1)

                                <div class="col-6 col-md-4 col-lg-3 col-xl-3">
                                    @include(\App\Setting\HomePage::theme('elements.product'),['product'=>$p])

                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                            @else
                                <div class="col-12 col-md-4 col-lg-9 col-xl-9">
                                    @include(\App\Setting\HomePage::theme('elements.product_list'),['product'=>$p])
                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                            @endif
                            @endforeach




                        </div><!-- End .row -->

                        {{-- <div class="load-more-container text-center">
                            <a href="#" class="btn btn-outline-darker btn-load-more">More Products <i class="icon-refresh"></i></a>
                        </div><!-- End .load-more-container --> --}}
                    </div><!-- End .products -->


                    @if ($products->hasPages())

                    <div class="d-flex justify-content-center shadow pt-3" >
                        {{-- {{ $onsale_group->links() }} --}}

                        {{ $products->links('pagination.default') }}
                    </div>
                    @endif

                    <div class="sidebar-filter-overlay"></div><!-- End .sidebar-filter-overlay -->
                    @include(\App\Setting\HomePage::theme('product.filter'))
                </div><!-- End .container -->
            </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection

