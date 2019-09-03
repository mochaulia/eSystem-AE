<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ css('bs.min.css') }}">
        <link rel="stylesheet" href="{{ css('fa.min.css') }}">
        <link rel="stylesheet" href="{{ css('bulletin.css') }}">
        <link rel="stylesheet" href="{{ css('gentelella.min.css') }}">
        <style type="text/css">
            .loader {
                border: 10px solid #f3f3f3;
                border-radius: 50%;
                border-top: 10px solid #3498db;
                width: 50px;
                height: 50px;
                left: 50%;
                margin-left: 40%;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        <title>
            {{ site_name() }} - Automation Engineering
        </title>
    </head>
    <body id="gradient">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div id="flashNews" class="x_panel_b x_panel text-center"></div>
                    <div id="newsUpdate" class="x_panel_b x_panel" style="min-height:555px"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="x_panel_b x_panel" style="min-height:760px">
                        <div class="x_panel_heading">
                            <h3 class="x_title">Akademik</h3>
                        </div>
                        <div id="newsByCat2"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="x_panel_b x_panel" style="min-height:760px">
                        <div class="x_panel_heading">
                            <h3 class="x_title">Lainnya</h3>
                        </div>
                        <div id="newsByCat1"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div id="youtube" class="embed-responsive embed-responsive-16by9"></div>
                    <br/>
                    <div id="apps" class="p-t x_panel_b x_panel"></div>
                    <div class="x_panel_b x_panel" style="min-height:202px">
                        <div class="panel-body" style="text-align:center; padding-top:40px">
                            <h4>More infos: <strong>http://ae.polman-bandung.ac.id</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="runningText" class="footer_c"></div>
        <script src="{{ js('jquery.min.js') }}"></script>
        <!-- <script src="{{ js('bs.min.js') }}"></script> -->
        <!-- <script src="{{ js('fastclick.js') }}"></script> -->
        <!-- <script src="{{ js('gentelella.js') }}"></script> -->
        <script src="{{ js('app/features/bulletinn.js') }}"></script>
    </body>
</html>
