<form id="createForm" class="form-horizontal form-label-left" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            {{ $header }}
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="email_to">
                To:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="email_to" name="email_to" required {{ (isset($id_to)) ? 'readonly' : '' }}
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-trigger="keyup"
                       value="{{ (isset($id_to)) ? user($id_to)->email : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="subject">
                Subject:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="subject" name="subject" required
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-trigger="keyup">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="text">
                Message:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea type="textarea" name="text" id="text"
                            class="form-control"
                            data-parsley-trigger="keyup"
                            aria-hidden="true"
                            rows="7"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        @if (isset($reply_for))
            <input type="hidden" name="reply_for" value="{{ $reply_for }}">
        @endif
        <input type="hidden" name="id_to" value="{{ (isset($id_to)) ? $id_to : '' }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>