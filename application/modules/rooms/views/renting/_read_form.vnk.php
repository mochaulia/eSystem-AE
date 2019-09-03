<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">
        Detail Booking Room
    </h4>
</div>
<div class="modal-body">
    <div class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="room">
            Room:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="room" name="room" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ $this->rooms_model->select(array('id' => $room_renting->id_room))->name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="starttime">
                Start Time:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="starttime" name="starttime" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ date("l, d-m-Y H:i", strtotime($room_renting->start)) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="endtime">
                End Time:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="endtime" name="endtime" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ date("l, d-m-Y H:i", strtotime($room_renting->end)) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="name">
                Name:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="name" name="name" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ user($room_renting->id_user)->first_name . ' ' . user($room_renting->id_user)->last_name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="category">
                Category:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="room" name="room" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ ucwords(str_replace('_', ' ', $room_renting->category)) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="room_name">
                Booking For:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="room_name" name="room_name" readonly
                       class="form-control col-md-7 col-xs-12"
                       value="{{ $room_renting->name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="description">
                Description:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="description" name="description" row="4" readonly
                          class="form-control">{{ $room_renting->description }}</textarea>
            </div>
        </div>
        @if ($room_renting->approval_letter)
            @if (is_admin() || $room_renting->id_user == user()->id)
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="app_letter">
                        Approval Letter:
                    </label>
                    <div class="col-md-7 col-sm-7 col-xs-12 control-label" style="text-align: left;">
                        <a href="{{ base_url('assets/'.$room_renting->approval_letter) }}" target="_blank">
                            Download <i class="fa fa-file-text-o"></i>
                        </a>
                    </div>
                </div>
            @endif
        @endif
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="note">
                Note:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="note" name="note" row="4" readonly
                          class="form-control">{{ $room_renting->note }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="status">
                Status:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12 control-label" style="text-align: left;">
                @if ($room_renting->approved == 1)
                    <i class="fa fa-check-circle" style="color:#1abb9c;font-size:1.3em;"> Approved</i>
                @elseif ($room_renting->approved == 0)
                    <i class="fa fa-times-circle" style="color:#d43f3a;font-size:1.3em;"> Denied</i>
                @elseif ($room_renting->approved == 9)
                    <i class="fa fa-minus-circle" style="color:#f0ad4e;font-size:1.3em;"> Waiting</i>
                @endif                    
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="progress">
                Progress:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12 control-label" style="text-align: left;">
                <div class="progress">
                    <div class="progress-bar progress-bar-{{ $meter_c }}" role="progressbar" aria-valuenow="50"
                         aria-valuemin="0" aria-valuemax="100" style="width:{{ $meter_f }}%">
                        {{ $meter_f }}% ({{ $meter_s }})
                    </div>
                </div>
            </div>
        </div>
        @if (is_admin() || $room_renting->id_user == user()->id)
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="app_note">
                    Approval/Denied Note from Admin:
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea id="app_note" name="app_note" data-id="{{ $room_renting->id }}" class="form-control" rows="3"
                            placeholder="(by Admin)" {{ (!is_admin()) ? 'readonly' : '' }}>{{ $room_renting->approval_note }}</textarea>
                </div>
            </div>
        @endif
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    @if (($room_renting->approved == 9 || $room_renting->approved == 1) && is_admin())
        <button data-appr="0" data-id="{{ $room_renting->id }}" type="button" class="btn btn-danger approveButton">Deny</button>
    @endif
    @if (($room_renting->approved == 9 || $room_renting->approved == 0) && is_admin())
        <button data-appr="1" data-id="{{ $room_renting->id }}" type="button" class="btn btn-success approveButton">Approve</button>
    @endif
</div>