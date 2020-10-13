@extends('layouts.adminlayouts.admin-design')
@section('content')
    <textarea name="product-desc" id="product-desc" cols="30" rows="10"></textarea>
@endsection
@section('scripts')
    <script src="{{ asset('js/backend-js/ckeditor4/ckeditor.js') }}"></script>
    <script type="text/javascript">
        
        CKEDITOR.replace('product-desc');
    </script>
@endsection