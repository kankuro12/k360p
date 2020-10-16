@extends('layouts.adminlayouts.admin-design')
@section('content')
    @php
        $tnc=\App\Term::first();
    @endphp
    <form action="{{route('admin.tnc')}}" method="post">
        @csrf
        <div class="">
            <div>
                <h5><strong>Customer Terms and Condition</strong></h5>
                <textarea id="ctnc" name="ctnc" style="max-width: 800px;">{{$tnc!=null?$tnc->ctnc:""}}</textarea>
            </div>
            <div>
                <h5><strong>Vendor Terms and Condition</strong></h5>
                <textarea id="vtnc" name="vtnc" style="max-width: 800px;">{{$tnc!=null?$tnc->vtnc:""}}</textarea>
            </div>
            <div>
                <h5><strong>Privacy Policy</strong></h5>
                <textarea id="pp" name="pp" style="max-width: 800px;">{{$tnc!=null?$tnc->pp:""}}</textarea>
            </div>
            <div style="padding-top:1rem;">
                <input type="submit" value="Save Terms and condition"  class="btn btn-primary">
            </div>
        </div>
    </form>
    
@endsection
@section('scripts')
    <script src="{{ asset('js/backend-js/ckeditor4/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ctnc');
        CKEDITOR.replace('vtnc');
        CKEDITOR.replace('pp');
    </script>
@endsection