<form id="createForm">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            Create News/Event
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="type">
                    Type:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <select id="type" name="type" class="form-control" required>
                        <option value="">
                            -
                        </option>
                        <option value="flashnews">
                            Flash News (will show in running text)
                        </option>
                        <option value="general">
                            General
                        </option>
                        <option value="event">
                            Event/Agenda
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="title">
                    Title:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="title" name="title" required
                           class="form-control col-md-7 col-xs-12"
                           data-parsley-trigger="keyup">
                </div>
            </div>
            <div id="timeForm" class="form-group" style="display:none">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="time">
                    Time:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="time" name="time"
                                           class="form-control col-md-7 col-xs-12"
                                           data-parsley-trigger="keyup">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div id="locationForm" class="form-group" style="display:none">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="location">
                    Location:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-map-marker"></i></span>
                                    <input type="text" id="location" name="location"
                                           class="form-control col-md-7 col-xs-12"
                                           data-parsley-trigger="keyup">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
                <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="category">
                    Category:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <select id="category" name="category" class="form-control" required>
                        <option value="">
                            -
                        </option>
                        <option value="general">
                            General
                        </option>
                        <option value="internal">
                            Internal
                        </option>
                        <option value="himpunanmahasiswa">
                            HIMA
                        </option>
                        <option value="akademik">
                            Akademik
                        </option>
                        <option value="kemahasiswaan">
                            Kemahasiswaan
                        </option>
                        <option value="beasiswa">
                            Beasiswa
                        </option>
                        <option value="seminar">
                            Seminar
                        </option>
                        <option value="loker">
                            Lowongan Kerja
                        </option>
                        <option value="lomba">
                            Lomba
                        </option>
                        <option value="lainnya">
                            Lainnya
                        </option>
                    </select>
                </div>
            </div>
            <div id="thumbnailForm" class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="thumbnail">
                    Thumbnail:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12 row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="thumbnail" name="thumbnail" readonly
                            class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
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
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="content">
                    Content:
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea type="textarea" name="content" id="content"
                              class="form-control"
                              data-parsley-trigger="keyup"
                              aria-hidden="true"
                              rows="20"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>