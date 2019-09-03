<div id="owl-carousel-1" class="owl-carousel owl-theme center-owl-nav main-carousel">
    @if (!$slider_news)
        <p>Item not found</p>
    @else
        @foreach ($slider_news as $news)
            <article class="article thumb-article">
                <div class="article-img">
                    <img src="{{ $news->thumbnail }}" alt="{{ $news->title }}">
                </div>
                <div class="article-body">
                    <ul class="article-info">
                        <li class="article-category">
                            <a href="{{ site_url('features/news/category?v=' . $news->category) }}">
                                {{ $news->category }}
                            </a>
                        </li>
                    </ul>
                    <h2 class="article-title">
                        <a href="{{ site_url('features/news/read?v=' . url_encode($news->id)) }}">
                            {{ $news->title }}
                        </a>
                    </h2>
                    <ul class="article-meta">
                        <li><i class="fa fa-clock-o"></i> {{ relative_date($news->created_at) }}</li>
                        <li>
                            <i class="fa fa-user-circle-o"></i> 
                            {{ user($news->id_creator)->first_name }} {{ user($news->id_creator)->last_name }}
                        </li>
                    </ul>
                </div>
            </article>
        @endforeach
    @endif
</div>