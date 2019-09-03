<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">
        Delete Product
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">
                Name:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" readonly
                       class="form-control col-md-7 col-sm-7 col-xs-12"
                       value="{{ $products->name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="facilities">
                Image:
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <img src="{{ $products->thumbnail }}" class="img-responsive">                
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <form id="deleteForm">  
        <input type="hidden" name="id" value="{{ $products->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
