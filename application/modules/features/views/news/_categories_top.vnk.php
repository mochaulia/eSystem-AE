@foreach ($this->news_model->categories_top() as $cat)
    <div class="col-md-4 col-sm-4">
        <div class="section-title">
            <h2 class="title">{{ $cat->category }}</h2>
        </div>
        @foreach ($this->news_model->by_category($cat->category) as $news)
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
    </div>
@endforeach