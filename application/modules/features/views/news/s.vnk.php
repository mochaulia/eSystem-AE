@extends('base')

@section('additional_stylesheet')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CLato:300,400" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ css('owl/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ css('owl/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ css('magnews.css') }}">
@endsection

@section('additional_script')
    <script type="text/javascript" src="{{ js('owl/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ js('magnews.js') }}"></script>
    <script type="text/javascript" src="{{ js('app/features/news.js') }}"></script>
@endsection

@section('nav_unique')
    @include('_navbar_ftr')
@endsection

@section('footer_unique')
    @include('_footer_ftr')
@endsection

@section('content_unique')
    <div id="sliderNews"></div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="trendingNews" class="col-md-8"></div>
                <div id="latestNews" class="col-md-4"></div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="catTopNews"></div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="catBottomNews"></div>
            </div>
        </div>
    </div>
    <div id="back-to-top"></div>
@endsection