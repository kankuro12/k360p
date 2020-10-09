<form action="{{route('elements.update-boxed',['item'=>$item->id])}}" method="post">
    @csrf

    @php
        $mobile=$item->mobile;
        $laptop=$item->laptop;
        $tab=$item->tab;
        $tv=$item->tv;
    @endphp
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group">
                <label >
                    <input type="checkbox" name="hascategory" id="hascategory" value="1" {{$item->hascategory==1?"checked":""}}> Has Category
                </label>
                <select name="category_id" id="category_id"  required style="width: 100%">
                    @foreach ($categories as $cat)
                        <option value="{{$cat->cat_id}}" {{$item->category_id==$cat->cat_id?"selected":""}}>{{$cat->cat_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>   
        <div class="col-md-12">
            <div class="form-group">
                <label >
                    Title
                </label>
               <input type="text" name="title" id="title" style="width: 100%" value="{{$item->title}}" placeholder="Enter Title">
            </div>
        </div>   
        <div class="col-md-4">
            <label >Order By</label>
            <select name="orderby" id="orderby" style="width: 100%" required>
                @foreach ($columns as $col)
                    <option value="{{$col}}" {{$item->orderby==$col?"selected":""}}>{{$col}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label >Order </label>
            <select name="order" id="order" style="width: 100%" required>
                <option value="0" {{$item->order==0?"selected":""}}>Asc</option>
                <option value="1" {{$item->order==1?"selected":""}}>Desc</option>
            </select>
        </div>
        <div class="col-md-4">
            <label >No of Displayed Product</label>
            <input value="{{$item->count}}" min="1" type="number" name="count" id="count"style="width: 100%" required>
        </div>

        <div class="col-md-12">
            <label ><input type="checkbox" name="hasquery" id="hasquery" value="1" {{$item->hasquery==1?"checked":""}}> Custom Query</label>
            <textarea name="mquery"  id="query" cols="30" rows="10" style="width:100%;">{{$item->query}}</textarea>
        </div>
        <div class="col-md-12">
            <div>
                <h5><strong>No Of Shown Item In </strong></h5>
                <div class="row">
                    <div class="col-md-3">

                        <label >mobile</label>
                        <input type="number" name="mobile" value="{{$mobile}}"  min="1" required class="form-control">
                    </div>
                    <div class="col-md-3">

                        <label >tab</label>
                        <input type="number" name="tab" min="1" value="{{$tab}}" required class="form-control">
                    </div>
                    <div class="col-md-3">

                        <label >laptop</label>
                        <input type="number" name="laptop" min="1" value="{{$laptop}}"  required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label >tv</label>
                        <input type="number" name="tv" min="1" value="{{$tv}}"  required class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <input type="submit" value="update" class="btn btn-primary">
         
            <a href="{{route('elements.del-boxed',['item'=>$item->id])}}" class="btn btn-danger">Delete</a>
        </div>
    </div>
</form>