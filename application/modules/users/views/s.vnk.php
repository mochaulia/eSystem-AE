@extends('base')

@section('additional_stylesheet')
    <link rel="stylesheet" href="{{ css('nprogress/nprogress.css') }}">
    <!-- pnotify -->    
    <link rel="stylesheet" href="{{ css('pnotify/pnotify.custom.min.css') }}">
    <!-- icheck -->    
    <link rel="stylesheet" href="{{ css('switchery/switchery.min.css') }}">
    <!-- icheck -->    
    <link rel="stylesheet" href="{{ css('icheck/icheck.green.css') }}">
    <!-- datatables -->
    <link rel="stylesheet" href="{{ css('datatables/dataTables.bootstrap.min.css') }}">
    <!-- scroll -->
    <link rel="stylesheet" href="{{ css('mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- template -->
    <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
@endsection

@section('additional_script')
    <!-- nprogress -->
    <script src="{{ js('nprogress/nprogress.js') }}"></script>
    <!-- icheck -->
    <script src="{{ js('icheck/icheck.min.js') }}"></script>
    <!-- switchery -->
    <script src="{{ js('switchery/switchery.min.js') }}"></script>
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
    <script src="{{ js('app/users/usersHandler.js') }}"></script>
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
                            <h2>{{ lang('index_heading') }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (is_admin())
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".modalCreateUser">
                                    <i class="fa fa-user-plus"></i>
                                </button>
                            @endif
                            <button type="button" class="btn btn-default refreshUsersTable"><i class="fa fa-refresh"></i></button>
                            <div class="usersTableDiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add modal -->
    <div class="modal fade modalCreateUser" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @include('users/_add_form')
            </div>
        </div>
    </div>
    <!-- /add modal -->
    <!-- edit modal -->
    <div class="modal fade modalEditUser" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /edit modal -->
    <!-- delete modal -->
    <div class="modal fade modalDeleteUser" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /delete modal -->
    <!-- privileges modal -->
    <div class="modal fade modalPrivileges" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /privileges modal -->
    <!-- /page content -->
@endsection