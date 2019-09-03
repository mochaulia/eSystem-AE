<div class="col-md-12">
    <div class="section-title">
        <h2 class="title">Category</h2>
        <ul class="tab-nav pull-right">
            @foreach ($this->news_model->categories_bottom() as $cat)
                <li class="{{ ($cat->category == 'beasiswa') ? 'active' : '' }}">
                    <a data-toggle="tab" href="#tab{{ $cat->category }}">{{ $cat->category }}</a>
                </li>
            @endforeach
            <li>
                <a data-toggle="tab" href="#tablainnya">Lainnya</a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        @foreach ($this->news_model->categories_bottom() as $cat)
            <div id="tab{{ $cat->category }}" class="tab-pane fade in {{ ($cat->category == 'beasiswa') ? 'active' : '' }}">
                <div class="row">
                    @foreach ($this->news_model->by_category($cat->category) as $news)
                    <div class="col-md-3 col-sm-6">
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
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div id="tablainnya" class="tab-pane fade in">
            <div class="row">
                @foreach ($this->news_model->by_category('lainnya') as $news)
                    <div class="col-md-3 col-sm-6">
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>