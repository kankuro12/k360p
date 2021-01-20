@extends('themes.molla.layouts.app')
@section('contant')
<div style="height:1px;"></div>
    <div class="">

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
        <div id="content">

            <div class="box1" style="background-color: rgb(132, 144, 26);"></div><div class="box1" style="background-color: rgb(180, 0, 160);"></div><div class="box1" style="background-color: rgb(148, 117, 184);"></div><div class="box1" style="background-color: rgb(87, 197, 66);"></div><div class="box1" style="background-color: rgb(114, 128, 56);"></div><div class="box1" style="background-color: rgb(127, 132, 138);"></div><div class="box1" style="background-color: rgb(15, 160, 117);"></div><div class="box1" style="background-color: rgb(12, 18, 194);"></div><div class="box1" style="background-color: rgb(219, 226, 224);"></div><div class="box1" style="background-color: rgb(42, 130, 39);"></div><div class="box1" style="background-color: rgb(20, 116, 61);"></div><div class="box1" style="background-color: rgb(188, 64, 188);"></div><div class="box1" style="background-color: rgb(250, 47, 69);"></div><div class="box1" style="background-color: rgb(117, 83, 111);"></div><div class="box1" style="background-color: rgb(85, 239, 61);"></div><div class="box1" style="background-color: rgb(59, 146, 55);"></div><div class="box1" style="background-color: rgb(105, 66, 239);"></div><div class="box1" style="background-color: rgb(62, 203, 74);"></div></div>
            <div id="aloader" class="active">

                LOADING...
            </div>

    </div>


@endsection
@section('popup')
    @include('themes.molla.layouts.popup')
@endsection
@section('js')
    <script>
        var waypoints = $('#aloader').waypoint({
            handler: function(direction) {
                alert(this.element.id + ' hit')
            }
        })
    </script>
@endsection
