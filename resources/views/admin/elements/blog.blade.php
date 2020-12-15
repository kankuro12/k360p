@extends('layouts.adminlayouts.admin-design')
@section('content')
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

                    <h4 class="card-title"> <a href="{{ route('elements') }}"><strong>Homepage Section</strong></a>/
                        Blog Display / <strong>{{ $section->name }}</strong></h4>
                    <div>

                    </div>
                    <div class="content-view">
                        <div id="root">
                            <form enctype="multipart/form-data" action="{{ route('elements.blog-save',$section->id)}}" method="post">
                                @csrf
                                <div class="row">
                                    @foreach($blog as $b)
                                    <div class="col-md-12">
                                        <input type="checkbox" name="blog_id[]" value="{{ $b->id }}"> <strong> {{ $b->title }} </strong>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-md-8 pr-md-1">
                                        <input type="submit" class="btn btn-fill btn-primary" value="submit">
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

<!-- list -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card" style="min-height: 200px;">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">

                    <h4 class="card-title"> <a href="{{ route('elements') }}"><strong>Homepage Section</strong></a>/
                        Blog Display / <strong> List</strong></h4>
                    <div>

                    </div>
                    <div class="content-view">
                        @php
                            $sectionWise = \App\BlogDisplay::where('home_page_section_id',$section->id)->get();
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Displayed Blog List</h5>
                                @foreach($sectionWise as $s)
                                    <p><strong> {{ $s->blog->title }} </strong><a href="{{ route('delete.blog',$s->id) }}" class="badge badge-danger">delete</a></p>
                                @endforeach
                            </div>
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