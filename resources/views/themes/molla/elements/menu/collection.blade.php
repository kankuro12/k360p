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
                                @foreach ($collection->items->take(4) as $item)
                                @php
                                    $product=$item->product;
                                @endphp
                                <div class="col-sm-12 col-md-6 ">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label label-new">{{$product->product_name}}</span>
                                            <a href="{{ route('product.detail',$product->product_id) }}">
                                                <img src="{{ asset($product->product_images) }}" alt="Product image" class="product-image">
                                            </a>
            
                                            <div class="product-action">
                                                <a href="{{ route('product.detail',$product->product_id) }}" class="btn-product btn-cart"><span>Shop Now</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->
            
                                      
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                @endforeach
                            </div><!-- End .row -->
                        </div><!-- End .menu-col -->
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <div class="banner banner-overlay h-100">
                            <a href="{{route('collection.detail',$collection->collection_id)}}" class="banner banner-menu h-100">
                                <img src="{{ asset($collection->collection_image) }}"
                                    alt="Banner" style="height:100%">
                            </a>
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .megamenu -->
       
        
    </li>
</ul>
