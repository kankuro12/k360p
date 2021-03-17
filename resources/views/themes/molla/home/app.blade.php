@extends('themes.molla.layouts.app')
@section('contant')
<div style="height:1px;"></div>
    <div class="">

        @foreach (App\model\admin\HomePageSection::where('parent_id', 0)
                ->where('type','<',7)
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
            <div  {{$c}} >
                <div class="row">
                    <div class="col-md-{{ $item->row }} " id="section_{{ $item->id }}">
                        @include($item->render() ,['data'=>$item])
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>

    </style>

    <div class="d-block d-md-none px-2">
        <div style="font-weight:600;font-size:2rem;">
            Our Products
        </div>
        <div id="content" >
        </div>
            <div id="aloader" class="active text-center" >
                LOADING...
            </div>


    </div>


@endsection
@section('popup')
    @include('themes.molla.layouts.popup')
@endsection
@section('js')
    <script>
        var hasproduct=true;
        var productlock=false;
        var productindex=0;
        function loadProduct(){
            if(!productlock && window.innerWidth<=576 && hasproduct){
                productlock=true;
                axios.post('{{route("public.getProducts")}}',{page:productindex})
                .then(function(response){
                    var data=response.data;
                    if(data.hasview){

                        $('#content').append(data.view);
                        productindex+=1;

                    }

                    hasproduct=data.hasmore;
                    productlock=false;
                })
                .catch(function(err){
                    console.log(err);
                    productlock=false;
                });
            }
        }

        loadProduct();
    </script>

@endsection
