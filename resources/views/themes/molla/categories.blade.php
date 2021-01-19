@extends('themes.molla.layouts.app')
@section('title','Categories')
@section('contant')
<main class="main">
    <div class="mobile-header d-flex d-md-none text-white hasbackground" >
        <span>
            <button style="background: none;outline:none;border:none;padding:5px;color:white;font-size:2rem;" onclick="goBack();"> < </button>
        </span>
        <span style="flex-grow:1;max-width:270px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;padding:8px 5px;">
            Categories
        </span>
    </div>

    <div class="page-content  {{env('enable_mobile_header',1)==1?"mt-5 mt-md-0  pt-md-0":""}}" style="border:none;">
        <div class="row">
            <div class="col-3">
                <div style="height: calc(100vh - 100px);overflow-y:scroll;word-wrap: break-word;background:#929292;text-align: center;border:1px solid black;padding:5px 0;">


                        @foreach ($categories as $category)
                            <div style="min-height:40px;">
                                <div>
                                    <img class="m-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAACYElEQVRIid2Uv09TURTHP+fd8l6xPwYSo4FIKBoXkw4WU0sRnppgQGochMnB0cS4aRzBf8G/wQ3i0hpw0AAxIBEH4z9gwsBmlFZKr+27DvTVUtpSZNJvcpZzz/1+zjvv5MK/omTy5plU6lZPY146N5iIVqziSwDldd/f2Fjc8c8SKfeuCK+AsjFe4tP66hf/zOrEPB4fD1XUbhYhg5CpqOJSMjkRrXUpcrHabJeIGqy/eyQgnU5H7Ih+AzIKrFQj1QhppbaAeHw8VDJdWQxp4H3RZsqUIpOCedcpJNDO3A7pHDBWNZ/o1jwRJx/0StGM5exkDXKjoopLAm/NcQCXXDdsa70IjAArumDf7g7rp8CsAcTJ75UKzh07rF8DYwaTaLUvhwDx+HjILukswki18ynfvK5s1gnroFeKTPpf0moSBwCJROaU2Pkcgls/lgZzAAw8s5w89eNqBlAHzJ18DuH6UeZ1GrECOuCVog+tQCkFEkM4F+vvm9/a2tI1QM2cY5m3goxVRI36EHVC89YQ1LVYf9+C6hvofYEwzf62TAZVpfGHdgyRgC7rgvNY2ZU0MOqhTqve/lgQwzf9035gH94WX3sCnwW2/QB6OLyFrrIrv3TBfqTs8lmMtVpb3qFhd65N59Oba8sL9YmhYfceMN+i/vnm2vIcVJ+Kyyn3Qhtz8GS7o9wfzVY99wGWJapN8V/J9+zouT4R6P8AiDY/2lYJ5zvK1UmVre/7ZVVdGXbXDVxtXm484GtDcgCk6QQEPnxcW05B/YgC3oyBHJjdJlcskMGGaGJudg3kCHgzfuY3kwvqMPBDPbgAAAAASUVORK5CYII=">

                                </div>
                                <div style="font-size:0.9rem;color:white;">

                                    {{$category->cat_name}}
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>
            <div class="col-9">

            </div>
        </div>
    </div>
@endsection
