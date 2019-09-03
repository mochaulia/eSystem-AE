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
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="article-breadcrumb">
                        <li><a href="{{ site_url('features/news') }}">News</a></li>
                        <li>
                            <a href="{{ site_url('features/news/category?v=' . $news->category) }}">
                                {{ $news->category }}
                            </a>
                        </li>
                        <li>{{ $news->title }}</li>
                    </ul>
                    <article class="article article-post">
                        <div class="article-share">
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <div class="article-main-img">
                            <img src="{{ ($news->thumbnail) ? $news->thumbnail : images('app/gallery/noimg.jpg') }}" alt="{{ $news->title }}">
                        </div>
                        <div class="article-body">
                            <ul class="article-info">
                                <li class="article-category">
                                    <a href="{{ site_url('features/news/category?v=' . $news->category) }}">
                                        {{ $news->category }}
                                    </a>
                                </li>
                            </ul>
                            <h1 class="article-title">{{ $news->title }}</h1>
                            <ul class="article-meta">
                                <li>
                                    <i class="fa fa-clock-o"></i> 
                                    {{ relative_date($news->created_at) }}
                                </li>
                                <li>
                                    <i class="fa fa-user-circle-o"></i> 
                                    {{ user($news->id_creator)->first_name }} {{ user($news->id_creator)->last_name }}
                                </li>
                            </ul>
                            {{ $news->text }}
                        </div>
                    </article>
                </div>
                <div id="latestNews" class="col-md-4"></div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <input id="category" type="hidden" name="category" value="{{ $news->category }}">
                <input id="id" type="hidden" name="id" value="{{ $news->id }}">
                <div id="relatedNews"></div>
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