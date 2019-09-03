<form id="editForm">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            Edit News/Event
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
                        <option value="flashnews" {{ ($news->type == 'flashnews') ? 'selected' : '' }}>
                            Flash News (will show in running text)
                        </option>
                        <option value="general" {{ ($news->type == 'general') ? 'selected' : '' }}>
                            General
                        </option>
                        <option value="event" {{ ($news->type == 'event') ? 'selected' : '' }}>
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
                            data-parsley-trigger="keyup"
                            value="{{ $news->title }}">
                </div>
            </div>
            <div id="timeForm" class="form-group" {{ ($news->type != "event") ? 'style="display:none"' : '' }}>
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
                                            data-parsley-trigger="keyup"
                                            value="{{ $news->time }}">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div id="locationForm" class="form-group" {{ ($news->type != "event") ? 'style="display:none"' : '' }}>
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
                                            data-parsley-trigger="keyup"
                                            value="{{ $news->location }}">
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
                        <option value="general" {{ ($news->category == 'flashnews') ? 'selected' : '' }}>
                            General
                        </option>
                        <option value="internal" {{ ($news->category == 'internal') ? 'selected' : '' }}>
                            Internal
                        </option>
                        <option value="himpunanmahasiswa" {{ ($news->category == 'himpunanmahasiswa') ? 'selected' : '' }}>
                            HIMA
                        </option>
                        <option value="akademik" {{ ($news->category == 'akademik') ? 'selected' : '' }}>
                            Akademik
                        </option>
                        <option value="kemahasiswaan" {{ ($news->category == 'kemahasiswaan') ? 'selected' : '' }}>
                            Kemahasiswaan
                        </option>
                        <option value="beasiswa" {{ ($news->category == 'beasiswa') ? 'selected' : '' }}>
                            Beasiswa
                        </option>
                        <option value="seminar" {{ ($news->category == 'seminar') ? 'selected' : '' }}>
                            Seminar
                        </option>
                        <option value="loker" {{ ($news->category == 'loker') ? 'selected' : '' }}>
                            Lowongan Kerja
                        </option>
                        <option value="lomba" {{ ($news->category == 'lomba') ? 'selected' : '' }}>
                            Lomba
                        </option>
                        <option value="lainnya" {{ ($news->category == 'lainnya') ? 'selected' : '' }}>
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
                            class="form-control col-md-7 col-xs-12"
                            value="{{ $news->thumbnail }}">
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
                              rows="20">{{ $news->text }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="{{ $news->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>