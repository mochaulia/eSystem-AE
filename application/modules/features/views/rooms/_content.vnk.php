@foreach ($rooms as $room)
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="card">
            <a class="img-card" data-toggle="modal" href="#modalRead" data-id="{{ $room->id }}">
            <img src="{{ images($room->pic) }}" />
            </a>
            <div class="card-content">
                <h4 class="card-title">
                    <a data-toggle="modal" href="#modalRead" data-id="{{ $room->id }}"> {{ $room->name }}</a>
                </h4>
                <p class="" style="text-overflow:clip;">
                    {{ substr(strip_tags($room->facilities), 0, 20) }}...
                </p>
                <button class="pull-right btn btn-default button-raised" data-toggle="modal" data-target="#modalRead" data-id="{{ $room->id }}">Read More
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
@endforeach