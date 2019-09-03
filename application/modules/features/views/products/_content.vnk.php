@foreach ($products as $product)
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="card">
            <a class="img-card" data-toggle="modal" href="#modalRead" data-id="{{ $product->id }}">
            <img src="{{ $product->thumbnail }}" />
            </a>
            <div class="card-content">
                <h4 class="card-title">
                    <a data-toggle="modal" href="#modalRead" data-id="{{ $product->id }}"> {{ $product->name }}</a>
                </h4>
                <p class="" style="text-overflow:clip;">
                    {{ substr(strip_tags($product->description), 0, 40) }}...
                </p>
                <button class="pull-right btn btn-default button-raised" data-toggle="modal" data-target="#modalRead" data-id="{{ $product->id }}">Read More
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
@endforeach