@extends('themes.molla.layouts.app')
@section('contant')
<div style="height:1px;"></div>
    <div class="d-none d-md-block">

        @foreach (App\model\admin\HomePageSection::where('parent_id', 0)
                ->orderBy('order', 'asc')
                ->get()
            as $item)
            {{-- {{ dd($item) }} --}}
            @php
            $c="";
            if($item->boxed==1){
            $c="style='margin-left:2rem;margin-right:2rem'";
            }elseif($item->boxed==2){
            $c="style='margin-left:1rem;margin-right:1rem'";
            }else{
            $c="";
            }
            @endphp
            <div  $c >
                <div class="row">
                    <div class="col-md-{{ $item->row }} " id="section_{{ $item->id }}">
                        @include($item->render() ,['data'=>$item])
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @php
        $products=\App\model\admin\Product::paginate(1);
    @endphp
    <div class="d-block d-md-none">
        @foreach ($products as $product)

        <div style="height:100px;background:#929292;">
            {{$product->product_name}}
        </div>
        @endforeach
        {{ $products->links() }}
    </div>

@endsection
@section('popup')
    @include('themes.molla.layouts.popup')
@endsection
@section('js')
    <script src="//unpkg.com/jscroll/dist/jquery.jscroll.min.js"></script>
    <script>
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endsection
