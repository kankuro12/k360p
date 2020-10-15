@extends('themes.molla.layouts.app')
@section('contant')
<div style="height:1px;"></div>

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
@endsection
@section('popup')
    @include('themes.molla.layouts.popup')
@endsection
