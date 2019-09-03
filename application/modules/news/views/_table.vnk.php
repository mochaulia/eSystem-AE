<table id="menuTable" class="table table-striped">  
    <thead>
        <tr>
            <th>No</th>
            <th>Title</th>     
            <th>Created</th>
            <th>Updated</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1
        @endphp
        @foreach ($results as $news)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $news->title }}</td>     
                <td>{{ relative_date($news->created_at)." ".date("H:i", $news->created_at) }} <em>by<em> <strong>{{ user($news->id_creator)->first_name }} {{ user($news->id_creator)->last_name }}</strong></td>
                <td>{{ ($news->updated_at) ? relative_date($news->updated_at)." ".date("H:i:s", $news->updated_at) : "-" }} <em>by</em> <strong>{{ ($news->id_updater) ? user($news->id_updater)->first_name." ".user($news->id_updater)->last_name : "-" }}</strong></td>
                <td>{{ $news->category }}</td>
                <td>
                    <a href="{{ site_url('features/news/read?v=') . url_encode($news->id) }}" target="_blank" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Open">
                        <i class="fa fa-external-link"></i>
                    </a>
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'update', $this->menus_model->select(array('alias' => $this->menus_name))->id) || $news->{$this->join_user} == user()->id)
                        <span data-toggle="modal" data-target="#modalEdit" data-menu-id="{{ $news->id }}">
                            <button type="button" class="btn btn-warning btn-xs " data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </span>
                    @endif
                    @if (is_admin() || $this->privileges_model->is(user()->id, 'delete', $this->menus_model->select(array('alias' => $this->menus_name))->id) || $news->{$this->join_user} == user()->id)                    
                        <span data-toggle="modal" data-target="#modalDelete" data-menu-id="{{ $news->id }}">
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