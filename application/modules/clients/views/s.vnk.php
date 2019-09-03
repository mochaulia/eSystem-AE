@extends('base')

@section('additional_stylesheet')
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- datatables -->
    <link rel="stylesheet" href="{{ css('datatables/dataTables.bootstrap.min.css') }}">
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
    <!-- datatables -->
    <script src="{{ js('datatables/dataTables.jquery.min.js') }}"></script>
    <script src="{{ js('datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- pnotify -->
    <script src="{{ js('pnotify/pnotify.custom.min.js') }}"></script>
    <!-- validator -->
    <script src="{{ js('parsley/parsley.min.js') }}"></script>
    <!-- scroll -->
    <script src="{{ js('mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- template -->
    <script src="{{ js('gentelella.js') }}"></script>
    <!-- handler -->
    <script src="{{ js('app/clients/clientsHandler.js') }}"></script>
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
                            @if (is_admin() || $this->privileges_model->is(user()->id, 'create', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCreate">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            @endif
                            <button id="refreshTable" type="button" class="btn btn-default">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <div id="tableDiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalCreate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="modalDelete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <div id="modalEditPic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /page content -->
@endsection