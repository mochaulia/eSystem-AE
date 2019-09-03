@extends('base')

@section('additional_stylesheet')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CLato:300,400" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ css('modalpinter/modalpinter.css') }}"> 
    <link rel="stylesheet" href="{{ css('owl/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ css('owl/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ css('magnews.css') }}">
@endsection 

@section('additional_script')
    <script type="text/javascript" src="{{ js('owl/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ js('magnews.js') }}"></script>
    <script type="text/javascript" src="{{ js('app/features/rooms.js') }}"></script>
@endsection

@section('nav_unique')
    @include('_navbar_ftr')
@endsection

@section('footer_unique')
    @include('_footer_ftr')
@endsection

@section('content_unique')
    <div class="container content-all">
        <div class="row">
            <h3>{{ $heading }} {{ $title }}</h3>  
        </div>
    </div>
    <div class="container content-all">
        <div class="row">
            @if (!$query)
                <p>Item not found</p>
            @else
                @foreach ($query as $room)
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card">
                            <a class="img-card" data-toggle="modal" href="#modalRead" data-id="{{ $room->id }}">
                            <img src="{{ images($room->pic) }}" />
                            </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a> {{ $room->name }}</a>
                                </h4>
                                <p class="" style="text-overflow:clip;">
                                    {{ substr(strip_tags($room->facilities), 0, 20) }}...
                                </p>
                                <button class="pull-right btn btn-default button-raised" data-toggle="modal" data-target="#modalRead" data-id="{{ $room->id }}">Read More
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div id="modalRead" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection