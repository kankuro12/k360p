@extends('themes.molla.layouts.app')
@section('title','Categories')
@section('contant')
<style>
    .selected{
        background: #929292 !important;
    }

    @media (max-width:576px){
        .page-wrapper{
            min-height:200px !important;
        }
        .footer{
            display:none;
        }
    }
</style>
<main class="main">
    <div class="mobile-header d-flex d-md-none text-white " style="background:#343A40 !important;" >
        <span>
            <button style="background: none;outline:none;border:none;padding:5px;color:white;font-size:2rem;" onclick="goBack();"> < </button>
        </span>
        <span style="flex-grow:1;max-width:270px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;padding:8px 5px;">
            Categories
        </span>
    </div>

    <div class="page-content  {{env('enable_mobile_header',1)==1?"mt-5 mt-md-0  pt-md-0 pb-md-5 pb-0":""}}" style="border:none;">
        <div class="row">
            <div class="col-3 p-0">
                <div style="height: calc(100vh - 112px);overflow-y:scroll;word-wrap: break-word;background:#343A40;text-align: center;">

                        @php
                            $count=0;;
                            $fid=0;
                        @endphp
                        @foreach ($categories as $category)
                            <div id="cat_{{$category->cat_id}}" class="cat" style="min-height:50px;position:relative;margin:2px;" class="cat" onclick="catClicked({{$category->cat_id}},this);">
                                @php
                                    if($count==0){
                                        $count+=1;
                                        $fid=$category->cat_id;
                                    }
                                @endphp

                                <div style="font-size:0.9rem;color:white; margin:auto;position:absolute;top:50%; transform: translateY(-50%);width:100%;word-wrap: break-word;padding:0px 5px;">
                                    {{$category->cat_name}}
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>
            <div class="col-9 p-0">
                <div id="content" style="height: calc(100vh - 115px);overflow-y:scroll;">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function catClicked(cat_id,ele) {
            $('.cat').removeClass('selected');
            $(ele).addClass('selected');
            axios.post("{{route('public.mob-categories')}}",{cat_id:cat_id})
            .then(function(response){
                $('#content').html(response.data);
            })
            .catch(function(err){
                console.log(err.response);
            });
        }

       catClicked({{$fid}},document.getElementById('cat_{{$fid}}'));


    </script>

@endsection
