@extends('themes.molla.layouts.app')
@section('contant')
    @foreach (App\model\admin\HomePageSection::where('parent_id', 0)
            ->orderBy('order', 'asc')
            ->get()
        as $item)
        {{-- {{ dd($item) }} --}}
        @php
        $c="";
        if($item->boxed==1){
        $c="container";
        }elseif($item->boxed==2){
        $c="container-fluid";
        }else{
        $c="";
        }
        @endphp
        <div class="{{ $c }}">
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
