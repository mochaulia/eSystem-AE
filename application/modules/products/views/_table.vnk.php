<table id="menuTable" class="table table-striped productsTable">  
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>     
            <th>Description</th>
            <th>PIC</th>
            <th>Years</th>
            <th>Input at</th>
            <th>Update at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1
        @endphp
        @foreach ($results as $product)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $product->name }}</td>     
                <td>{{ substr(strip_tags($product->description), 0, 100) }}...</strong></td>
                <td>{{ $product->pic_name }}</td>
                <td>{{ $product->years }}</td>
                <td>{{ relative_date($product->created_at)." ".date("H:i", $product->created_at) }} <em>by<em> <strong>{{ user($product->id_creator)->first_name }} {{ user($product->id_creator)->last_name }}</strong></td>
                <td>{{ ($product->updated_at) ? relative_date($product->updated_at)." ".date("H:i:s", $product->updated_at) : "-" }} <em>by</em> <strong>{{ ($product->id_updater) ? user($product->id_updater)->first_name." ".user($product->id_updater)->last_name : "-" }}</strong></td>
                <td>
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'read', $this->menus_model->select(array('alias' => $this->menus_name))->id) || $product->{$this->join_user} == user()->id)
                        <span data-toggle="modal" data-target="#modalRead" data-menu-id="{{ $product->id }}">
                            <button type="button" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="Details">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => $this->menus_name))->id) || $product->{$this->join_user} == user()->id)
                        <span data-toggle="modal" data-target="#modalEdit" data-menu-id="{{ $product->id }}">
                            <button type="button" class="btn btn-warning btn-xs " data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => $this->menus_name))->id) || $product->{$this->join_user} == user()->id)                    
                        <span data-toggle="modal" data-target="#modalDelete" data-menu-id="{{ $product->id }}">
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