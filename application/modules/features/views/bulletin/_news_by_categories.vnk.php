@foreach ($this->bulletin->{$ke}() as $heading => $category)
    @foreach ($this->bulletin->category($category) as $news)
        @if (!$this->bulletin->category($category))
        @else
            <div class="x_content">
                <ul class="list-unstyled timeline_c timeline">
                <li>
                    <h2 class="title">
                        <a>{{ $news->title }}</a>
                    </h2>
                    <div>
                        <span><strong><i>{{ relative_date($news->created_at) }}</i></strong>  in {{$news->category}}</span>
                    </div>
                </li>
                </ul>
            </div>
        @endif
    @endforeach
@endforeach