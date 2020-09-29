@extends('layouts.adminlayouts.admin-design')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card" style="min-height: 200px;">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        @php
                        $data=$section->getElement();
                        @endphp
                        <h4 class="card-title"> <a href="{{ route('elements') }}"><strong>Homepage Section</strong></a>/
                            Slider / <strong>{{ $section->name }}</strong></h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('elements.add-slider', ['group' => $data->id]) }}">Add
                                New Slider</a>
                        </div>
                        <div class="content-view">
                            <div id="root">
                                @foreach ($data->sliders as $slider)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ asset($slider->slider_image) }}" alt="" srcset=""
                                                style="width: 100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <strong>Primary Text</strong>
                                                    </td>
                                                    <td>
                                                        {{ $slider->primary_text }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Secondary Text</strong>
                                                    </td>
                                                    <td>
                                                        {{ $slider->secondary_text }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Button Text</strong>
                                                    </td>
                                                    <td>
                                                        {{ $slider->button_text }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>link Text</strong>
                                                    </td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="{{ $slider->link_text }}">{{ $slider->link_text }}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <form
                                                            action="{{ route('elements.del-slider', ['slider' => $slider->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="submit" value="Delete" class="btn btn-danger">
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                        </div>
                                    </div>
                                @endforeach
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


    <!--Add Tag  Modal -->
    @include('admin.elements.section')
@endsection

@section('scripts')

@endsection
