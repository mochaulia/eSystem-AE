@extends('base') 
@section('additional_stylesheet')
<link rel="stylesheet" href="{{ css('landing/animate.css') }}">
<link rel="stylesheet" href="{{ css('landing/templatemo_misc.css') }}">
<link rel="stylesheet" href="{{ css('landing/templatemo_style.css') }}"> 
@endsection 
@section('additional_script')

<script src="{{ js('landing/jquery.lightbox.js') }}"></script>
<script src="{{ js('landing/templatemo.js') }}"></script>
@endsection 
@section('content_unique')
<div class="container body">
    <div class="main_container">
        <div class="flex-center position-ref full-height">
            <div class="site-header">
                <div class="main-navigation">
                    <div class="responsive_menu">
                        <ul>
                            @if(is_anonymous())
                            <li>
                                <a class="show-1 templatemo_home" href="{{ site_url('auth/login') }}">{{ lang('login_heading') }}</a>
                            </li>
                            <li>
                                <a class="show-2 templatemo_page2" href="{{ site_url('auth/register') }}">{{ lang('create_user_register_heading') }}</a>
                            </li>
                            @else
                            <li>
                                <a class="show-2 templatemo_page2" href="{{ site_url('dashboard') }}">{{ lang('dashboard_heading') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="container">
                        <div class="row templatemo_gallerygap">
                            <div class="col-md-12 responsive-menu">
                                <a href="#" class="menu-toggle-btn">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                            <!-- /.col-md-12 -->
                            <div class="col-md-3 col-sm-12" style="align:center">
                                <h1 href="#">
                                    {{ $title }}
                                    <!-- <img style="max-width:70%;" src="{{ images_base64('icon/logo_esystem_title.png') }}" alt="eSystem AE"> -->
                                </h1>
                            </div>
                            <div class="col-md-9 main_menu">
                                <ul>
                                    @if(is_anonymous())
                                    <li>
                                        <a class="show-1 templatemo_page2" href="{{ site_url('auth/login') }}">
                                            <span class="fa fa-sign-in"></span>
                                            {{ lang('login_heading') }}</a>
                                    </li>
                                    <li>
                                        <a class="show-2 templatemo_page2" href="{{ site_url('auth/register') }}">
                                            <span class="fa fa-user-plus"></span>
                                            {{ lang('create_user_register_heading') }}</a>
                                    </li>
                                    @else
                                    <li>
                                        <a class="" href="{{ site_url('dashboard') }}">
                                            <span class="fa fa-tachometer"></span>
                                            {{ lang('dashboard_heading') }}</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!-- gallery start -->
                <div class="content homepage">
                    <div class="container" style="align:center">
                        <div class="row templatemorow">
                            <div class="hex col-sm-6">
                                <div>
                                    <div class="hexagon hexagon2 gallery-item">
                                        <div class="hexagon-in1">
                                            <div class="hexagon-in2" style="background-image: url({{ images_base64('icon/bu.jpg') }});">
                                                <div class="overlay">
                                                    <a href="{{ site_url('features/bulletin') }}" class="fa fa-expand"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hex col-sm-6">
                                <div>
                                    <div class="hexagon hexagon2 gallery-item">
                                        <div class="hexagon-in1">
                                            <div class="hexagon-in2" style="background-image: url({{ images_base64('icon/ne.jpg') }});">
                                                <div class="overlay">
                                                    <a href="{{ site_url('features/news') }}" class="fa fa-expand"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hex col-sm-6  templatemo-hex-top2">
                                <div>
                                    <div class="hexagon hexagon2 gallery-item">
                                        <div class="hexagon-in1">
                                            <div class="hexagon-in2" style="background-image: url({{ images_base64('icon/pro.jpg') }});">
                                                <div class="overlay">
                                                    <a href="{{ site_url('features/products') }}" class="fa fa-expand"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hex col-sm-6  templatemo-hex-top3">
                                <div>
                                    <div class="hexagon hexagon2 gallery-item">
                                        <div class="hexagon-in1">
                                            <div class="hexagon-in2" style="background-image: url({{ images_base64('icon/ru.jpg') }});">
                                                <div class="overlay">
                                                    <a href="{{ site_url('features/rooms') }}" class="fa fa-expand"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hex col-sm-6  templatemo-hex-top3">
                                <div>
                                    <div class="hexagon hexagon2 gallery-item">
                                        <div class="hexagon-in1">
                                            <div class="hexagon-in2" style="background-image: url({{ images_base64('icon/book.jpg') }});">
                                                <div class="overlay">
                                                    <a href="{{ site_url('features/rooms-usage') }}" class="fa fa-expand"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection