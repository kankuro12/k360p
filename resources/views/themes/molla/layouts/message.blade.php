@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert" style="margin-top: 10px;">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert" style="margin-top: 10px;">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif