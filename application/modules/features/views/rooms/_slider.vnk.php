<div id="owl-carousel-1" class="owl-carousel owl-theme center-owl-nav main-carousel">
    @if (!$sliders)
        <p>Item not found</p>
    @else
        @foreach ($sliders as $room)
            <article class="article thumb-article">
                <div class="article-img">
                    <img src="{{ images($room->pic) }}" alt="{{ $room->name }}">
                </div>
                <div class="article-body">
                    </ul>
                    <h2 class="article-title">
                        <a data-toggle="modal" href="#modalRead" data-id="{{ $room->id }}">{{ $room->name }}</a>
                    </h2>
                </div>
            </article>
        @endforeach
    @endif
</div>