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
                    <div class="section-title">
                        <h2 class="title">{{ $heading }} {{ $title }}</h2>
                    </div>
                    @if (!$query)
                        <p>Item not found</p>
                    @else
                        @foreach ($query as $news)
                            <article class="article row-article">
                                <div class="article-img">
                                    <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                                        <img src="{{ ($news->thumbnail) ? $news->thumbnail : images('app/gallery/noimg.jpg') }}" alt="{{ $news->title }}">
                                    </a>
                                </div>
                                <div class="article-body">
                                    <ul class="article-info">
                                        <li class="article-category">
                                            <a href="{{ site_url('features/news/category?v=' . $news->category) }}">
                                                {{ $news->category }}
                                            </a>
                                        </li>
                                    </ul>
                                    <h3 class="article-title">
                                        <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                                            {{ $news->title }}
                                        </a>
                                    </h3>
                                    <ul class="article-meta">
                                        <li><i class="fa fa-clock-o"></i> {{ relative_date($news->created_at) }}</li>
                                        <li>
                                            <i class="fa fa-user-circle-o"></i> 
                                            {{ user($news->id_creator)->first_name }} {{ user($news->id_creator)->last_name }}
                                        </li>
                                    </ul>
                                    <p>{{ substr(strip_tags($news->text), 0, 80) }}...</p>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
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