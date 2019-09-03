<table id="menuTable" class="table table-striped">  
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Logo</th>
            <th>Action</th>            
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1
        @endphp
        @foreach ($results as $client)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->address }}</td>
                <td><img src="{{ images_base64($client->logo) }}" class="img-responsive" style="width:100px"></td>
                <td>
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalEdit" data-menu-id="{{ $client->id }}">
                            <button type="button" class="btn btn-warning btn-xs " data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalEditPic" data-menu-id="{{ $client->id }}">
                            <button type="button" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="Edit Logo">
                                <i class="fa fa-picture-o"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => $this->menus_name))->id))
                        <span data-toggle="modal" data-target="#modalDelete" data-menu-id="{{ $client->id }}">
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