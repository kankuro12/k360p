@extends('layouts.adminlayouts.admin-design')
@section('content')
    @php
        $about=\App\AboutUs::first();
    @endphp
    <form action="{{route('admin.about')}}" method="post">
        @csrf
        <div class="">
            <div>
                <h5><strong> About Us in brief</strong></h5>
                <textarea  name="mini" style="width: 100%;">{{$about!=null?$about->mini:""}}</textarea>
            </div>
            <div>
                <h5><strong>Full About Us</strong></h5>
                <textarea id="full" name="full" style="max-width: 800px;">{{$about!=null?$about->full:""}}</textarea>
            </div>
            <div style="padding-top:1rem;">
                <input type="submit" value="Save About Us"  class="btn btn-primary">
            </div>
        </div>
    </form>
    
@endsection
@section('scripts')
    <script src="{{ asset('js/backend-js/ckeditor4/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('full');
    </script>
@endsection