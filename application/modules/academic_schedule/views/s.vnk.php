@extends('base')

@section('additional_stylesheet')
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- pnotify -->    
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <!-- colorpicker -->    
    <link rel="stylesheet" href="{{ css('colorpicker/colorpicker.min.css') }}">
    <!-- fullcalendar -->
    <link rel="stylesheet" href="{{ css('fullcalendar/fullcalendar.min.css') }}">    
    <!-- scroll -->
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- template -->
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
    <style type="text/css">
        .modal { overflow: auto !important; }
    </style>
@endsection

@section('additional_script')
    <!-- nprogress -->
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <!-- pnotify -->
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
    <!-- colorpicker -->
    <script src="{{ js('colorpicker/colorpicker.min.js') }}"></script>
    <!-- validator -->
    <script src="{{ js('parsley/parsley.min.js') }}"></script>
    <!-- fullcalendar -->
    <script src="{{ js('fullcalendar/fullcalendar.moment.min.js') }}"></script>
    <script src="{{ js('fullcalendar/fullcalendar.min.js') }}"></script>
    <!-- scroll -->
    <script src="{{ js('mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- template -->
    <script src="{{ js('gentelella.js') }}"></script>
    <!-- template -->
    <script src="{{ js('app/academic_schedule/academicScheduleHandler.js') }}"></script>
@endsection

@section('sidebar')
    @include('_sidebar')
@endsection

@section('nav')
    @include('_navbar')
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $title }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <button id="refreshTable" type="button" class="btn btn-default">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <div style="margin-bottom:10px;">
                                <select id="yearShow" class="form-control">
                                    <option value="">
                                        -- All Years --
                                    </option>
                                    @foreach ($this->{$this->model}->years() as $year)
                                        <option value="{{ $year->id }}">
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom:10px;">
                                <select id="classShow" class="form-control">
                                    <option value="">
                                        -- All Class --
                                    </option>
                                    @foreach ($this->{$this->model}->classes() as $class)
                                        <option value="{{ $class->id }}">
                                            {{ strtoupper($class->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="academicSchedule"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalCreate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div id="dateTempCreate"></div>
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div id="uniqueTempUpdate"></div>
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="modalAddYear" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
    <div id="modalAddClass" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content"></div>
        </div>
    </div>
@endsection