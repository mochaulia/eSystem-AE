<form id="createForm" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            New Booking Room
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="room">
               Room:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="room" name="room" class="form-control" required>
                    <option value="">
                        -
                    </option>
                    @foreach ($this->rooms_model->select() as $room)
                        <option value="{{ $room->id }}" data-pic="{{ images_base64($room->pic) }}">
                            {{ strtoupper($room->name) }}
                        </option>
                    @endforeach
                </select>
                <img id="image-prev" class="img-responsive" style="margin-top:10px;">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="startDate">
                Start Time:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="startDate" name="startDate" readonly
                       class="form-control col-md-7 col-xs-12">
                <input type="hidden" id="start" name="start">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="endDate">
                End Time:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="endDate" name="endDate" readonly
                       class="form-control col-md-7 col-xs-12">
                <input type="hidden" id="end" name="end">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="category">
               Category:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="category" name="category" class="form-control" required>
                    <option value="">
                        -
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
                    <option value="demo">
                        Demo Produk
                    </option>
                    <option value="bimbingan">
                        Bimbingan
                    </option>
                    <option value="lainlain">
                        Lain-Lain
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                Name:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="name" name="name" required
                       placeholder="(Short Description)"
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-maxlength="20"
                       data-parsley-trigger="keyup">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="description">
                Description:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="description" name="description" required
                          class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="app_letter">
                Approval Letter:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="file" id="app_letter" name="app_letter"
                        class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="note">
                Note:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="note" name="note" class="form-control" rows="3"
                          placeholder="(Optional)"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>