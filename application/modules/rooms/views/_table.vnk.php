<table id="menuTable" class="table table-striped">  
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Facilities</th>
            <th>Pic</th>
            <th>Action</th>            
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1
        @endphp
        @foreach ($results as $room)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ substr(strip_tags($room->facilities), 0, 50) }}...</td>
                <td><img src="{{ images_base64($room->pic) }}" class="img-responsive" style="width:100px"></td>
                <td>
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'read', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalRead" data-menu-id="{{ $room->id }}">
                            <button type="button" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Read">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalEdit" data-menu-id="{{ $room->id }}">
                            <button type="button" class="btn btn-warning btn-xs " data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalEditPic" data-menu-id="{{ $room->id }}">
                            <button type="button" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="Edit Picture">
                                <i class="fa fa-picture-o"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalDelete" data-menu-id="{{ $room->id }}">
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </span>
                    @endif
                </td>
            </tr>
            @php
                $no++
            @endphp
        @endforeach
    </tbody>
</table>