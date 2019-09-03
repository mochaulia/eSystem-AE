<form id="createForm" enctype="multipart/form-data" accept-charset="utf-8">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="modalCreateUserLabel">
            Add Client
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                    Name:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="text" id="name" name="name" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-trigger="keyup">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="logo">
                    Logo:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="file" id="logo" name="logo" required
                        class="form-control col-md-7 col-xs-12" style="margin-bottom:20px;">
                    <img id="image-prev" class="img-responsive" style="width:75%">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="address">
                    Address:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea id="address" name="address" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-trigger="keyup"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>