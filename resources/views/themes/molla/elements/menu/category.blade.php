@php
    $attr=\App\model\admin\Category::find($menu->parent_id)
@endphp
<ul class="menu-vertical sf-arrows">
    <li class="megamenu-container">
        @if (count($attr->subcat) > 0)
            <a class="sf-with-ul" href="{{ url('shop-by-category/' . $attr->cat_id) }}"><i class="icon-blender"></i>
                {{ $menu->menu_name }}</a>
            <div class="megamenu" style="min-height: 300px;">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="menu-col">
                            <div class="row">
                                @if (count($attr->subcat))
                                    @foreach ($attr->subcat as $item)
                                        <div class="col-md-4">
                                            <div class="menu-title"><a
                                                    href="{{ url('shop-by-category/' . $item->cat_id) }}">
                                                    {{ $item->cat_name }} </a></div><!-- End .menu-title -->
                                            @if (count($item->subcat))
                                                @foreach ($item->subcat as $item1)
                                                    <ul>
                                                        <li><a
                                                                href="{{ url('shop-by-category/' . $item1->cat_id) }}">{{ $item1->cat_name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        </div><!-- End .col-md-6 -->
                                    @endforeach
                                @endif
                            </div><!-- End .row -->
                        </div><!-- End .menu-col -->
                    </div><!-- End .col-md-8 -->

                 
                </div><!-- End .row -->
            </div><!-- End .megamenu -->
        @endif
        @if (count($attr->subcat) == null)
            <a href="{{ url('shops-by-category/' . $attr->cat_id) }}"><i class="icon-blender"></i> {{ $attr->cat_name }}</a>
        @endif
    </li>
</ul>
