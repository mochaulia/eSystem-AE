<form id="editForm" class="form-horizontal form-label-left">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
            Edit Schedule
        </h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="year">
               Academic Years:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="row col-md-10 col-sm-10 col-xs-10">
                    <select id="year" name="year" class="form-control" required>
                        <option value="">
                            -
                        </option>
                        @foreach ($this->{$this->model}->years() as $year)
                            <option value="{{ $year->id }}" {{ ($academic_schedule->id_academic_year == $year->id ? 'selected' : '') }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <button id="addYear" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddYear">
                        <i class="fa fa-plus-square"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="class">
               Class:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="row col-md-10 col-sm-10 col-xs-10">
                    <select id="class" name="class" class="form-control" required>
                        <option value="">
                            -
                        </option>
                        @foreach ($this->{$this->model}->classes() as $class)
                            <option value="{{ $class->id }}" {{ ($academic_schedule->id_class == $class->id ? 'selected' : '') }}>
                                {{ strtoupper($class->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <button id="addClass" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddClass">
                        <i class="fa fa-plus-square"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="class">
               Absen:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <select id="absen" name="absen" class="form-control" required>
                    <option value="">
                        -
                    </option>
                    <option value="atas" {{ ($academic_schedule->absen == 'atas' ? 'selected' : '') }}>
                        Atas
                    </option>
                    <option value="bawah" {{ ($academic_schedule->absen == 'bawah' ? 'selected' : '') }}>
                        Bawah
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="subject">
               Subject:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="subject" name="subject" required
                       class="form-control col-md-7 col-xs-12"
                       data-parsley-type="alphanum"
                       data-parsley-min-length="3"
                       data-parsley-trigger="keyup"
                       value="{{ $academic_schedule->subject }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="color">
               Color:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div id="colorPick" class="input-group colorpicker-component">
                    <input type="text" id="color" name="color" required
                        class="form-control col-md-7 col-xs-12"
                        data-parsley-trigger="keyup"
                        value="{{ $academic_schedule->color }}">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="description">
               Description:
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <textarea id="description" name="description" rows="3"
                          class="form-control col-md-7 col-xs-12"
                          placeholder="(Optional)"
                          data-parsley-trigger="keyup">{{ $academic_schedule->description }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="{{ $academic_schedule->id }}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>