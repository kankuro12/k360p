<form action="" method="post">
    @csrf
    <style>
        .cc {
            border: none;
            width: 100%;
        }

        .cc:focus {
            border: black 1px solid;
        }

    </style>
    <p class="prod-desc"><strong>Stock Type: </strong>
        <select name="stocktype" id="stocktype" class="cc">
            <option value="0" {{ $productdetail->stocktype == 0 ? 'selected' : '' }}>Simple</option>
            <option value="1" {{ $productdetail->stocktype == 1 ? 'selected' : '' }}>Variant</option>
        </select>

    </p>
    <p class="prod-desc"><strong>Description: </strong>
        <textarea name="product_short_description" id="product_short_description"
            class="cc">{{ $productdetail->product_short_description }}</textarea>

    </p>
    <p class="prod-desc"><strong>Category: </strong>
        {{-- <span class="label label-rose">
            {{ $productdetail->parent_category }}</span></p> --}}
    <select name="category_id" id="category_id" class="cc">
        {!! $categorydropdown !!}
    </select>
    </p>
    <p class="prod-desc"><strong>Brand: </strong>
        <select name="brand_id" id="brand_id" class="cc">
            {!! $branddropdown !!}
        </select>
    </p>
    {{-- <p class="prod-desc"><strong>Stock Status:
        </strong>{{ $productdetail->stockstatus }}</p> --}}
    <p class="prod-desc"><strong>Mark Price (Rs) :</strong>
        <input required type="number" step="0.01" name="mark_price" value="{{ $productdetail->mark_price }}" class="cc"
            placeholder="Enter Product Price">


    </p>
    <p class="prod-desc"><strong>Sale Price (Rs) : </strong>
        <input required type="number" step="0.01" name="mark_price" value="{{ $productdetail->sell_price }}" class="cc"
            placeholder="Enter Product Price">
    </p>
    <p class="prod-desc"><strong>Tags: </strong>
    <div class="cc">
        <input value="{{ $productdetail->tags }}" name="tags" class="cc" required data-role="tagsinput"
            name="attributeitem" id="attributeitem" required />
    </div>


    </p>
    @if ($productdetail->stocktype == 0)

        <p class="prod-desc"><strong>Quantity: </strong>
            <input required type="number" step="0.01" name="quantity" value="{{ $productdetail->quantity }}" class="cc"
                placeholder="Enter Product Price">


        </p>
    @endif

    <p class="prod-desc"><strong>Featured: </strong>
        <input type="checkbox" name="featured" id="featured">
        @if ($productdetail->featured == 1)
            <span class="label label-primary">Featured</span>

        @else
            <span class="label label-danger">Not Featured</span>
        @endif
    </p>
</form>
