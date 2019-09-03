<table class="table table-striped usersTable">  
    <thead>
        <tr>
            <th>{{ lang('index_id_th') }}</th>
            <th>{{ lang('index_ava_th') }}</th>
            <th>{{ lang('index_email_th') }}</th>
            <th>{{ lang('index_uname_th') }}</th>
            <th>{{ lang('index_full_name_th') }}</th>
            @if (is_admin())
                <th>{{ lang('index_role_th') }}</th>
                <th>{{ lang('index_lastlog_th') }}</th>
                <th>{{ lang('index_status_th') }}</th>
                <th>{{ lang('index_action_th') }}</th>
            @else
                <th>{{ lang('index_major_th') }}</th>
                <th>{{ lang('index_phone_th') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach (users() as $user)
            @if (!is_admin() && $user->username == 'admin')
                @continue
            @endif
            <tr {{ ($user->gender == 'F') ? 'style="font-weight:bold"' : '' }}>
                <td>{{ $user->id }}</td>
                <td><img src="{{ images_base64($user->avatar) }}" style="width: 29px; height: 29px; border-radius: 50%;"></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                @if (is_admin())
                    <td>{{ users_group_one($user->id)->description }}</td>
                    <td>{{ ($user->last_login) ? relative_date($user->last_login)." ".date("H:i:s", $user->last_login) : "-" }}</td>
                    <td>
                        <div class="checkbox">
                            <input type="checkbox" class="changeStatus"
                                   data-user-id="{{ $user->id }}" 
                                   {{ ($user->active) ? 'checked' : ''}}
                                   {{ ($user->username == 'admin') ? 'disabled' : '' }}>
                        </div>
                    </td>
                    <td>
                        <span data-toggle="modal" data-target=".modalEditUser" data-user-id="{{ $user->id }}">
                            <button type="button" class="btn btn-primary btn-xs " data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </span>
                        <span data-toggle="modal" data-target=".modalPrivileges" data-user-id="{{ $user->id }}">                
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Privileges">
                                <i class="fa fa-braille"></i>
                            </button>
                        </span>
                        @if ($user->username !== 'admin')
                            <span data-toggle="modal" data-target=".modalDeleteUser" data-user-id="{{ $user->id }}">
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </span>
                        @endif
                    </td>
                @else
                    <td>{{ $this->majors_model->select(array('id' => $user->id_major))->name }}</td>
                    <td>{{ $user->phone }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>