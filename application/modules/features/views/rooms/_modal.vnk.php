<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="fa fa-close" aria-hidden="true"></span>
    </button>
    <h4 class="modal-title" id="myModalLabel" style="text-align:center;">{{ $room->name }}</h4>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <img class="img-responsive" src="{{ images($room->pic) }}">
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 h4">
                <table class="">
                    <tr>
                        <th class="th_p">Name:</th>
                        <td>{{ $room->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 h4" style="margin-top:40px;">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#fac" aria-controls="desc" role="tab" data-toggle="tab">Facilities</a>
                    </li>
                </ul>
                <div class="tab-content" style="margin-top:20px;">
                    <div role="tabpanel" class="tab-pane fade in active" id="fac">{{ $room->facilities }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>