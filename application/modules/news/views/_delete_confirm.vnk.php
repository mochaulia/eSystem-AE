<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">
        Delete News/Event
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                Type:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"
                    value={{ $news->type }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                Title:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"
                    value={{ $news->title }}>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                Creator:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"                   
                    value="{{ user($news->{$this->join_user})->first_name }} {{ user($news->{$this->join_user})->last_name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                Category:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" readonly
                    class="form-control col-md-7 col-xs-12"                   
                    value={{ $news->category }}>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <form id="deleteForm">  
        <input type="hidden" name="id" value="{{ $news->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
