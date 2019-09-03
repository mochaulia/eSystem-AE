@extends('base')

@section('additional_stylesheet')
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- pnotify -->
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <!-- scroll -->
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- template -->
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
@endsection

@section('additional_script')
    <!-- nprogress -->
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <!-- validator -->
    <script src="{{ js('parsley/parsley.min.js') }}"></script>
    <!-- pnotify -->
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
    <!-- scroll -->
    <script src="{{ js('mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- template -->
    <script src="{{ js('gentelella.js') }}"></script>
    <!-- handler -->
    <script src="{{ js('app/gallery/galleryHandler.js') }}"></script>
    <script type="text/javascript">
        getGalleryDiv();
    </script>
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
                            <a href="{{ site_url('gallery/add') }}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                            <button type="button" class="btn btn-default refreshGalleryTable"><i class="fa fa-refresh"></i></button>
                            <div class="galleryDiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- edit modal -->
    <div id="modalEditGallery" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /edit modal -->
    <!-- delete modal -->
    <div id="modalDeleteGallery" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /delete modal -->
    <!-- /page content -->
@endsection