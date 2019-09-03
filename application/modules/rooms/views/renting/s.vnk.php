@extends('base')

@section('additional_stylesheet')
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- pnotify -->    
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <!-- fullcalendar -->
    <link rel="stylesheet" href="{{ css('fullcalendar/fullcalendar.min.css') }}">
    <!-- scroll -->
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- template -->
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
@endsection

@section('additional_script')
    <!-- nprogress -->
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <!-- pnotify -->
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
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
    <script src="{{ js('app/rooms/rentingHandler.js') }}"></script>
@endsection

@section('sidebar')
    @include('_sidebar')
@endsection

@section('nav')
    @include('_navbar')
@endsection

@section('content')
    <!-- page content -->
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
                                <select id="myShow" class="form-control">
                                    <option value="">
                                        - All -
                                    </option>
                                    <option value="my">
                                        Only My Booking
                                    </option>
                                </select>
                            </div>
                            <div style="margin-bottom:10px;">
                                <select id="statusShow" class="form-control">
                                    <option value="">
                                        - All Status -
                                    </option>
                                    <option value="pending" {{ (is_admin() ? 'selected' : '') }}>
                                        Pending
                                    </option>
                                    <option value="noaction">
                                        Read by Admin
                                    </option>
                                    <option value="approved">
                                        Approved
                                    </option>
                                    <option value="denied">
                                        Denied
                                    </option>
                                </select>
                            </div>
                            <div style="margin-bottom:10px;">
                                <select id="roomsShow" class="form-control">
                                    <option value="">
                                        - All Rooms -
                                    </option>
                                    @foreach ($this->rooms_model->select() as $room)
                                        <option value="{{ $room->id }}">
                                            {{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="roomRenting"></div>
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
    <div id="modalRead" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div id="uniqueTempUpdate"></div>
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /page content -->
@endsection