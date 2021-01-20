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
    <style>
        .box1{
            height:300px;
        }
    </style>
    <div class="d-block d-md-none">
        <div id="content">

            <div class="box1" style="background-color: rgb(132, 144, 26);"></div>
            <div class="box1" style="background-color: rgb(180, 0, 160);"></div>
            <div class="box1" style="background-color: rgb(148, 117, 184);"></div>
            <div class="box1" style="background-color: rgb(87, 197, 66);"></div>
        </div>
            <div id="aloader" class="active">

                LOADING...
            </div>
            <div style="height:60px;">

            </div>

    </div>


@endsection
@section('popup')
    @include('themes.molla.layouts.popup')
@endsection
@section('js')

@endsection
