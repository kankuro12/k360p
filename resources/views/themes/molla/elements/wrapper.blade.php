<div class="row">
    @foreach (App\model\admin\HomePageSection::where('parent_id', $data->id)->get() as $item_1)
        <div class="col-md-{{ $item_1->row }} order-md-{{ $item_1->order }} pt-1" id="section_{{ $item_1->id }}">
            @if ($item_1->boxed == 1)
                <div class="container">
                    @include($item_1->render() ,['data'=>$item_1])
                </div>
            @else
                @include($item_1->render() ,['data'=>$item_1])
            @endif
        </div>
    @endforeach
</div>
