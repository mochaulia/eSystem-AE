<div class="col-md-12">
    <div class="section-title">
        <h2 class="title">Related Post</h2>
    </div>
    <div class="row">
        @if (!$related)
            <p>Item not found</p>
        @else
            @foreach ($related as $news)
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
        @endif
    </div>
</div>