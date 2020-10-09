@extends('themes.molla.layouts.app')
@section('contant')
    <div class="row">
        @foreach (App\model\admin\HomePageSection::where('parent_id', 0)->orderBy('order', 'asc')->get() as $item)
            <div class="col-md-{{ $item->row }} " id="section_{{ $item->id }}">
                @if ($item->boxed == 1)
                    <div class="container">
                        @include($item->render() ,['data'=>$item])
                    </div>
                @elseif ($item->boxed == 2)
                    <div class="container-fluid">
                        @include($item->render() ,['data'=>$item])
                    </div>
                @else
                    @include($item->render() ,['data'=>$item])
                @endif
            </div>
        @endforeach
    </div>
@endsection

