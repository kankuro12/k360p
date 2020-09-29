@extends('themes.molla.layouts.app')
@section('contant')
    <div class="row">
        @foreach (App\model\admin\HomePageSection::where('parent_id', 0)->orderBy('order','asc')->get() as $item)
            <div class="col-md-{{ $item->row }} " id="section_{{$item->id}}">
                @include($item->render() ,['data'=>$item])
            </div>
        @endforeach
    </div>
@endsection
