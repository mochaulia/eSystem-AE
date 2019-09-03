<div class="section-title">
    <h2 class="title">Latest News</h2>
</div>
<div id="owl-carousel-3" class="owl-carousel owl-theme center-owl-nav">
    @if (!$latest_w_carousel)
        <p>Item not found</p>
    @else
        @foreach ($latest_w_carousel as $news)
            <article class="article">
                <div class="article-img">
                    <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                        <img src="{{ ($news->thumbnail) ? $news->thumbnail : images('app/gallery/noimg.jpg') }}" alt="{{ $news->title }}">
                    </a>
                </div>
                <div class="article-body">
                    <h4 class="article-title">
                        <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                            {{ $news->title }}
                        </a>
                    </h4>
                    <ul class="article-meta">
                        <li><i class="fa fa-clock-o"></i> {{ relative_date($news->created_at) }}</li>
                    </ul>
                </div>
            </article>
        @endforeach
    @endif
</div>
@if (!$latest)
    <p>Item not found</p>
@else
    @foreach ($latest as $news)
        <article class="article widget-article">
            <div class="article-img">
                <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                    <img src="{{ ($news->thumbnail) ? $news->thumbnail : images('app/gallery/noimg.jpg') }}" alt="{{ $news->title }}">
                </a>
            </div>
            <div class="article-body">
                <h4 class="article-title">
                    <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                        {{ $news->title }}
                    </a>
                </h4>
                <ul class="article-meta">
                    <li><i class="fa fa-clock-o"></i> {{ relative_date($news->created_at) }}</li>
                </ul>
            </div>
        </article>
    @endforeach
@endif