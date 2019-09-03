@extends('base')

@section('additional_stylesheet')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CLato:300,400" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ css('modalpinter/modalpinter.css') }}">
    <link rel="stylesheet" href="{{ css('fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ css('owl/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ css('owl/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ css('magnews.css') }}">
@endsection 

@section('additional_script')
    <script src="{{ js('owl/owl.carousel.min.js') }}"></script>
    <script src="{{ js('fullcalendar/fullcalendar.moment.min.js') }}"></script>
    <script src="{{ js('fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ js('magnews.js') }}"></script>
    <script src="{{ js('app/features/roomsUsage.js') }}"></script>
@endsection

@section('nav_unique')
    @include('_navbar_ftr')
@endsection

@section('footer_unique')
    @include('_footer_ftr')
@endsection

@section('content_unique')
    <div id="slidersDiv"></div>
    <div class="container content-all">
        <div id="mainCol" class="row" style="margin-bottom:15px;"></div>
    </div>
    <div id="modalRead" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection