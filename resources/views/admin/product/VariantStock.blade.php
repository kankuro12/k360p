<div>
    <form action="{{ url('admin/product-attribute/add/' . $productdetail->product_id) }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <select class="selectpicker" data-live-search="true" id="attribute" name="attribute"
                    data-style="btn btn-primary " title="Select Attribute" data-size="3" required>
                    @foreach (App\model\admin\Attribute_group::all() as $item)
                        <option data-id="{{ $item->str_attributes() }}" value="{{ $item->attribute_group_name }}">
                            {{ $item->attribute_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 p-2">
                <label for="attributeitem">write attribute and press enter</label>
                <div style="border : red 1px solid;">
                    <input required data-role="tagsinput" name="attributeitem" id="attributeitem" required />
                </div>

            </div>

        </div>
        <div>
            <button class="btn btn-primary">Add Attribute</button>
        </div>
    </form>
</div>
<hr>
<div>
    <div class="row">
        @foreach (App\model\admin\Product_attribute::where('product_id', $productdetail->product_id)->get() as $attribute)
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item active">
                        <a href="{{ url('/admin/product-attribute/del/' . $attribute->id) }}" class="badge">del</a>
                        {{ $attribute->name }}
                    </li>
                    @foreach ($attribute->items as $item)
                        <li class="list-group-item">
                            <a href="{{ url('/admin/product-attribute-item/del/' . $item->id) }}" class="badge">del</a>
                            {{ $item->name }}
                        </li>

                    @endforeach
                    <li class="list-group-item">
                        <form action="{{ url('admin/product-attribute-item/add/' . $attribute->id) }}" method="post">
                            @csrf
                            <label for="attributeitem">Write attributes and press enter</label>
                            <div style="border : red 1px solid;">
                                <input required data-role="tagsinput" name="attributeitem"
                                    id="attributeitem_{{ $attribute->id }}" required />
                            </div>
                            <button class="btn btn-primary">Add attributes</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
</div>
<hr>
@php
    $attributes=App\model\admin\Product_attribute::where('product_id', $productdetail->product_id)->get();

@endphp
@if ($attributes->count()>0) 
<div id="placement">
    <h2 style="font-weight: 800">Add Stock</h2>
    <hr>
    <form action="{{ url('admin/product-stock/add/' . $productdetail->product_id) }}" method="POST">
        @csrf
        <div class="row">

            @foreach ($attributes as $attribute)
                <div class="col-md-4">
                    <input type="hidden" name="attributes[]" value="{{ $attribute->id }}" />
                    <select class="selectpicker" data-live-search="true" id="attribute_{{ $attribute->id }}"
                        name="attribute_{{ $attribute->id }}" data-style="btn btn-primary "
                        title="Select A {{ $attribute->name }}" data-size="3" required>
                        @foreach ($attribute->items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label >Price</label>
                    <input required type="number" value="{{ $productdetail->mark_price }}" min="0" class="form-control"
                        id="price" placeholder="Price" name="price">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sale Price</label>
                    <input required type="number" value="{{ $productdetail->mark_price }}" min="0" class="form-control"
                        id="saleprice" name="saleprice" placeholder="Sale Price">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input required type="number" value="0" min="0" class="form-control" id="qty" name="qty"
                        placeholder="Quantity">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button class="btn btn-primary">Add Stock</button>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Variant
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        SalePrice
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ( App\model\ProductStock::where('product_id',$productdetail->product_id)->get() as $stock)
                    <tr>
                        <form action="{{url('admin/product-stock/update/'.$stock->id)}}" method="post">
                            @csrf
                        <td>
                            @foreach (App\Setting\VariantManager::codeToString($stock->code) as $item)
                                <p>
                                    {{$item['attribute']['name']}}: {{$item['item']['name']}}
                                </p>
                            @endforeach 
                        </td>
                        <td>
                            <input type="number" name="price" id="stoc_price" value="{{$stock->price}}" />
                        </td>
                        <td>
                            <input type="number" name="saleprice" id="stoc_saleprice" value="{{$stock->saleprice}}" />
                        </td>
                        <td>
                            <input type="number" name="qty" id="stoc_qty" value="{{$stock->qty}}" />
                        </td>
                        <td>
                            <button class="btn btn-primary">update</button>
                        </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
