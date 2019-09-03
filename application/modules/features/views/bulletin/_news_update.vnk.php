<div class="x_panel_heading">
    <h3 class="x_title">News/Event Update</h3>
</div>
<div class="x_content">
    <ul class="list-unstyled timeline">
        @if (!$this->bulletin->news_update())
            <li>No item found</li>
        @else
            @foreach ($this->bulletin->news_update() as $news_update)
                <li>
                    <div class="blocks">
                        <div class="tags">
                            <a>
                                <img class="img-circle" src="{{ images_base64(user($news_update->id_creator)->avatar) }}">
                            </a>
                        </div>
                        <div class="block_content">
                            <h2 class="title">
                                <a>
                                    {{ $news_update->title }}
                                    <small>in<strong> {{ $news_update->category }}</strong></small>
                                </a>
                            </h2>
                            <div style="font-style: italic">
                                <span>{{ relative_date($news_update->created_at) }}</span> by <strong>{{ user($news_update->id_creator)->first_name }} {{ user($news_update->id_creator)->last_name }}</strong>
                            </div>
                            <p class="excerpt">
                                {{ substr(strip_tags($news_update->text), 0, 50) }}...
                                <a href="{{ site_url('features/news/read?v=' . url_encode($news_update->id)) }}"><strong>Read More</strong></a>
                            </p>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>