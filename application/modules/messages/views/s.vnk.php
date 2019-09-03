@extends('base')

@section('additional_stylesheet')
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <link rel="stylesheet" href="{{ css('easyautocomplete/easy-autocomplete.min.css') }}">
    <link rel="stylesheet" href="{{ css('easyautocomplete/easy-autocomplete.themes.min.css') }}">
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
@endsection

@section('additional_script')
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <script src="{{ js('tinymce/tinymce.min.js') }}"></script>
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
    <script src="{{ js('easyautocomplete/jquery.easy-autocomplete.min.js') }}"></script>
    <script src="{{ js('parsley/parsley.min.js') }}"></script>
    <script src="{{ js('mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ js('gentelella.js') }}"></script>
    <script src="{{ js('app/messages/messagesHandler.js') }}"></script>
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
                            <div class="row">
                                <div class="col-sm-3 mail_list_column">
                                    <button id="compose" 
                                            class="btn btn-sm btn-success btn-block" 
                                            type="button"
                                            data-toggle="modal"
                                            data-target="#modalCompose">
                                            <i class="fa fa-pencil-square-o"></i> Compose
                                    </button>
                                    <div id="messagesLeft"></div>
                                </div>
                                <div class="col-sm-9 mail_view">
                                    <div id="readRight">
                                        <p class="text-center">Select a message.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalCompose" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="modalDelete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <input id="ajaxGet" type="hidden" value="{{ base_url('messages') }}">
@endsection