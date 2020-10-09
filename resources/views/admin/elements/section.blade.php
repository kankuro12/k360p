<div class="modal" id="addsection" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Section <span id="Parent"></span></h5>

            </div>
            <div class="modal-body">

                <div>
                    <form action="{{ route('elements.add') }}" method="post" id="addsection_form">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="parent_id" id="parent_id" value="" required>
                            <select class="selectpicker" data-live-search="true" id="type" name="type"
                                data-style="btn btn-primary btn-round" title="Select Element Type" data-size="5">
                                @foreach (\App\Setting\Homepage::sectiontype as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input placeholder="Enter Section Name" type="text" name="name" id="name"
                                class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Order</label>
                                    <input placeholder="Enter Order" type="number" min="0" name="order" id="order"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rows</label>
                                    <input placeholder="Enter Rows" type="number" min="1" max="12" name="row" id="row"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label >Box Style</label>
                                <select name="boxed" class="form-control">
                                    <option value="0">Full Width</option>
                                    <option value="1">Boxed</option>
                                    <option value="2">Boxed-fluid</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="save()">Add Section</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="margin-bottom: 0px;" onclick="$('#addsection_form')[0].reset();">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="editsection" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Section <span id="Parent"></span></h5>

            </div>
            <div class="modal-body">

                <div>
                    <form action="{{ url('admin/element/edit') }}" method="post" id="editsection_form">
                        @csrf
                        <input type="hidden" name="id" id="e_id">
                        <div class="form-group">
                            <label>Title</label>
                            <input placeholder="Enter Section Name" type="text" name="name" id="e_name"
                                class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Order</label>
                                    <input placeholder="Enter Order" type="number" min="0" name="order" id="e_order"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rows</label>
                                    <input placeholder="Enter Rows" type="number" min="1" max="12" name="row" id="e_row"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label >Box Style</label>
                                <select name="boxed" class="form-control">
                                    <option value="0">Full Width</option>
                                    <option value="1">Boxed</option>
                                    <option value="2">Boxed-fluid</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveedit()">Update Section</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="margin-bottom: 0px;">Close</button>
            </div>
        </div>
    </div>
</div>