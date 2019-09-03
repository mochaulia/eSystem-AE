<div id="owl-carousel-1" class="owl-carousel owl-theme center-owl-nav main-carousel">
    @if (!$slider_products)
        <p>Item not found</p>
    @else
        @foreach ($slider_products as $product)
            <article class="article thumb-article">
                <div class="article-img">
                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}">
                </div>
                <div class="article-body">
                    </ul>
                    <h2 class="article-title">
                        <a data-toggle="modal" href="#modalRead" data-id="{{ $product->id }}">{{ $product->name }}</a>
                    </h2>
                </div>
            </article>
        @endforeach
    @endif
</div>