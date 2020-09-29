<div>
    <form action="{{ url('admin/product-option/' . $productdetail->product_id) }}" method="post">
        @php

        $option=$productdetail->option();

        @endphp
        @csrf

        <div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> Warrenty Type</label>
                        <select class="selectpicker" title="Select a Warranty type" class="form-control" type="text"
                            name="warrenty" id="warrenty">
                            @foreach (\App\Setting\ProductManager::warrenty as $key => $warrenty)
                                <option value="{{ $key }}"
                                    {{ $option != null ? ($option->warrenty == $key ? 'selected' : '') : '' }}>
                                    {{ $warrenty }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>


                <div class="col-md-4">
                    <label for=""> Warrenty Period</label>

                    <input placeholder="Enter Period" class="form-control" type="number" name="warrentyperiod"
                        id="warrentyperiod" min="0" value="{{ $option != null ? $option->warrentyperiod:''}}">
                </div>
                <div class="col-md-4">
                    <label for=""> Warrenty Period Type</label>

                    <select class="selectpicker" title="Select a Period type" class="form-control" type="text"
                        name="	warrentytime" id="	warrentytime">
                        <option value="Day"   {{ $option != null ? ($option->warrentytime == 'Day' ? 'selected' : '') : '' }}>Day</option>
                        <option value="Month"  {{ $option != null ? ($option->warrentytime == 'Month' ? 'selected' : '') : '' }}>Month</option>
                        <option value="Year" {{ $option != null ? ($option->warrentytime == 'Year' ? 'selected' : '') : '' }}>Year</option>

                    </select>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""><input type="checkbox" name="isrefundable" id="isrefundable"  {{ $option != null ? ($option->isrefundable?'checked' : '') : '' }} value="1"> Refundable 
                        </label>
                        <hr>
                        <label >
                            Refundable Policy
                        </label>   
                        <textarea class="form-control" name="refundablepolicy" id="refundablepolicy">{{ $option != null ? $option->refundablepolicy : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary">Save Product Options</button>
        </div>
    </form>
</div>
