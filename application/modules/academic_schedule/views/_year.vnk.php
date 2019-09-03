<form id="addYearForm" class="form-horizontal form-label-left">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            Add Year
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name_comp">
            Year:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="name_comp" name="name_comp" required
                    class="form-control col-md-7 col-xs-12"
                    data-parsley-max-length="11"
                    data-parsley-trigger="keyup">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="description">
            Info:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="description" name="description" rows="3"
                        class="form-control col-md-7 col-xs-12"
                        placeholder="(Optional)"
                        data-parsley-trigger="keyup"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Add</button>
    </div>
</form>