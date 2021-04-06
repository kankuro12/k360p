@extends('layouts.adminlayouts.admin-design')
@section('content')
    @php
        $about=\App\AboutUs::first();
    @endphp
    <form action="{{route('admin.about')}}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="">
            <div>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                        <img src="{{ asset($about!=null?$about->logo:"")}}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select App Logo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="logo" required />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
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
