@extends('layouts.adminlayouts.admin-design')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" />
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
                <span>
                    <b> Success - </b>{!! session('flash_message') !!}</span>
            </div>
            @endif

            <div class="card" style="min-height: 200px;">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">

                    <h4 class="card-title"> <a href="{{ route('elements.mob') }}"><strong>Homepage Section</strong></a>/
                        Mobile Ad/ <strong>{{ $section->name }}</strong></h4>
                    <div>

                    </div>
                    <div class="content-view">
                        <div id="root">
                            <form action="{{route('elements.mob.save-ad',['section'=>$section->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label for="">Image</label>
                                    <input type="file" class="dropify" required data-default-file="{{$ad->image!=null?asset($ad->image):""}}" name="image">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                               
                               
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>



@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
    $('.dropify').dropify();

</script>
@endsection 