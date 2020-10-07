@php
    $collection=\App\model\admin\Collection::find($menu->parent_id);
@endphp
<ul class="menu-vertical sf-arrows">
    <li class="megamenu-container">
       
            <a class="sf-with-ul" href="{{ url('collection-product/' . $collection->collection_id) }}"><i class="icon-blender"></i>
                {{ $menu->menu_name }}</a>
            <div class="megamenu">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="menu-col">
                            <div class="row">
                                @foreach ($collection->items->take(4) as $col)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label label-new">Collection</span>
                                            <a href="{{ route('collection.detail',$col->collection_id) }}">
                                                <img src="{{ asset($col->collection_image) }}" alt="Product image" class="product-image">
                                            </a>
            
                                            <div class="product-action">
                                                <a href="{{ route('collection.detail',$col->collection_id) }}" class="btn-product btn-cart"><span>Shop Now</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->
            
                                        <div class="product-body">
                                            <h3 class="product-title"><a href="{{ route('collection.detail',$col->collection_id) }}">{{ $col->collection_name }}</a></h3><!-- End .product-title -->
                                            <p>{{ $col->collection_description }}</p>
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                @endforeach
                            </div><!-- End .row -->
                        </div><!-- End .menu-col -->
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <div class="banner banner-overlay">
                            <a href="category.html" class="banner banner-menu">
                                <img src="{{ asset($collection->collection_image) }}"
                                    alt="Banner">
                            </a>
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .megamenu -->
       
        
    </li>
</ul>
