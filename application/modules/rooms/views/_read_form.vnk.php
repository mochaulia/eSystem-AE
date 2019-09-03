<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="modalCreateUserLabel">
        {{ $rooms->name }}
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                Name:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="name" name="name" readonly
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-trigger="keyup"
                       value="{{ $rooms->name }}">
            </div>
        </div>
        <div class="form-group" style="margin-bottom:30px;">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="facilities">
                Image:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <img src="{{ images_base64($rooms->pic) }}" class="img-responsive">                
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                Facilities:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                {{ strip_tags($rooms->facilities) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
