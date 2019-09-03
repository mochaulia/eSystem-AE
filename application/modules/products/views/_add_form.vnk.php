<form id="createForm">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            Add Product
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                    Name:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="name" name="name" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-maxlength="50"
                           data-parsley-trigger="keyup">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="pic_name">
                    PIC <em>(Person in Control)</em>:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="pic_name" name="pic_name" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-maxlength="20"
                           data-parsley-trigger="keyup">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="teams">
                    Teams:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea type="textarea" name="teams" id="teams"
                              class="form-control"
                              data-parsley-trigger="keyup"
                              rows="3"></textarea>
                </div>
            </div>
            <div id="thumbnailForm" class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="thumbnail">
                    Image:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12 row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" id="thumbnail" name="thumbnail" readonly required
                               class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a id="buttonOpenGallery" class="btn btn-primary" data-toggle="modal" data-target="#modalOpenGallery" data-src="{{ site_url('gallery/ajax_div_mine/modal') }}">
                            Browse...
                        </a>
                    </div>
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
                    <input type="text" id="years" name="years"
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-trigger="keyup">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="client">
                    Client:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <select id="client" name="client" class="form-control">
                        <option value="">
                            -
                        </option>
                        @foreach ($this->{$this->model}->clients() as $client)
                            <option value="{{ $client->id }}">
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="description">
                    Description:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea type="textarea" id="description" name="description"
                              class="tinymce form-control"
                              data-parsley-trigger="keyup"
                              rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="tools">
                    Tools:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea type="textarea" name="tools" id="tools"
                              class="form-control"
                              data-parsley-trigger="keyup"
                              rows="2"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="workpack">
                    Work Package:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea type="textarea" name="workpack" id="workpack"
                              class="form-control"
                              data-parsley-trigger="keyup"
                              rows="2"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="status">
                    Status:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <select id="status" name="status" class="form-control" required>
                        <option value="">
                            -
                        </option>
                        <option value="developing">
                            Developing
                        </option>
                        <option value="designing">
                            Designing
                        </option>
                        <option value="training">
                            Training
                        </option>
                        <option value="consulting">
                            Consulting
                        </option>
                        <option value="implementing">
                            Implementing
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="status_haki">
                    Status HAKI:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="status_haki" name="status_haki" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-maxlength="50"
                           data-parsley-trigger="keyup">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>