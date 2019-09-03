<div class="section-title">
    <h2 class="title">Trending News</h2>
</div>
@if (!$main_news)
    <p>Item not found</p>
@else
    @foreach ($main_news as $news)
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
<!-- <div class="article-pagination">
    <ul> 
        <li class="active"><a href="#" class="active">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
    </ul>
</div> -->