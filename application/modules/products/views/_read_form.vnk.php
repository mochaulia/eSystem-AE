<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">
        Details Product
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                Name:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="name" name="name" readonly
                        class="form-control col-md-7 col-xs-12"
                        data-parsley-maxlength="50"
                        value="{{ $products->name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="pic_name">
                PIC <em>(Person in Control)</em>:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="pic_name" name="pic_name" readonly
                        class="form-control col-md-7 col-xs-12"
                        data-parsley-maxlength="20"
                        value="{{ $products->pic_name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="teams">
                Teams:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <textarea type="textarea" name="teams" id="teams" readonly
                            class="form-control"
                            rows="3">{{ $products->teams }}</textarea>
            </div>
        </div>
        <div id="thumbnailForm" class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="thumbnail">
                Image:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12 row">
                <input type="hidden" id="thumbnail" value="{{ $products->thumbnail }}">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <img class="img-responsive" id="prevThumbnail" style="width: 400px; margin-top: 10px;">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="years">
                Years:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="years" name="years" readonly
                        class="form-control col-md-7 col-xs-12"
                        value="{{ $products->years }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="client">
                Client:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="years" name="years" readonly
                        class="form-control col-md-7 col-xs-12"
                        value="{{ $this->{$this->model}->clients(array('id' => $products->id_client))->name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="description">
                Description:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12 control-label" style="text-align:left">
                {{ $products->description }}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="tools">
                Tools:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <textarea type="textarea" name="tools" id="tools" readonly
                          class="form-control"
                          rows="3">{{ $products->tools }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="workpack">
                Work Package:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <textarea type="textarea" name="workpack" id="workpack" readonly
                          class="form-control"
                          rows="3">{{ $products->workpack }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="status">
                Status:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="status" name="status" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ ucwords($products->status) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="status_haki">
                Status HAKI:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="status_haki" name="status_haki" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ ucwords($products->status_haki) }}">
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-success">Save</button>
</div>