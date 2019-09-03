<!-- left navigation -->
<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ site_url('dashboard') }}" class="site_title">
                <i class="fa fa-television"></i>
                <span>{{ site_name() }}</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ images_base64(user()->avatar) }}" alt="user-avatar" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ user()->first_name }} {{ user()->last_name }}</h2>
            </div>
        </div>
        <br />
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Main Menu</h3>                
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ site_url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    @foreach ($this->menus_model->select() as $menu)
                        @if ($menu->alias == 'academic_schedule' || $menu->alias == 'room_renting')
                            @if ($this->privileges_model->is(user()->id, 'read', $menu->id))
                                <li>
                                    <a href="{{ site_url($menu->url) }}"><i class="fa fa-{{ $menu->icon }}"></i> {{ $menu->name }}
                                        @if (is_admin() && $menu->alias == 'room_renting')
                                            <span id="roomPendingCount"></span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    <li>
                        <a>
                            <i class="fa fa-id-card-o"></i> Messages
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ site_url('messages/inbox') }}"><span class="fa fa-envelope-o"></span>Inbox</a>
                            </li>
                            <li>
                                <a href="{{ site_url('messages/sents') }}"><span class="fa fa-share"></span>Sent</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
                <div class="menu_section">
                    <h3>Bulletin</h3>   
                        <ul class="nav side-menu">
                            @if (is_admin())
                                <li>
                                    <a href="{{ site_url('features/bulletin/youtube') }}"><i class="fa fa-youtube"></i> YouTube Playlist</a>
                                </li>
                            @endif
                            @foreach ($this->menus_model->select() as $menu)
                                @if ($menu->alias == 'news')
                                    @if ($this->privileges_model->is(user()->id, 'have_access', $menu->id))
                                        <li>
                                            <a>
                                                <i class="fa fa-{{ $menu->icon }}"></i> {{ $menu->name }}
                                                <span class="fa fa-chevron-down"></span>
                                            </a>
                                            <ul class="nav child_menu">
                                                @if ($this->privileges_model->is(user()->id, 'read', $menu->id))
                                                    <li>
                                                        <a href="{{ site_url($menu->url) }}"><span class="fa fa-table"></span>Show</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ site_url($menu->url.'/mine') }}"><span class="fa fa-hand-pointer-o"></span>My {{ $menu->name }}</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                </div>
            <div class="menu_section">
                <h3>Data</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ site_url('users') }}"><i class="fa fa-users"></i> Users</a>
                    </li>
                    @foreach ($this->menus_model->select() as $menu)
                        @if ($menu->alias !== 'news' && $menu->alias !== 'academic_schedule' && $menu->alias !== 'room_renting')
                            @if ($this->privileges_model->is(user()->id, 'have_access', $menu->id))
                                <li>
                                    @if ($menu->alias == 'rooms' || $menu->alias == 'clients')
                                        <a href="{{ site_url($menu->url) }}"><i class="fa fa-{{ $menu->icon }}"></i>{{ $menu->name }}</a>
                                    @else
                                        <a>
                                            <i class="fa fa-{{ $menu->icon }}"></i> {{ $menu->name }}
                                            <span class="fa fa-chevron-down"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            @if ($this->privileges_model->is(user()->id, 'read', $menu->id))
                                                <li>
                                                    <a href="{{ site_url($menu->url) }}"><span class="fa fa-table"></span>Show</a>
                                                </li>
                                            @endif
                                            @if ($this->privileges_model->is(user()->id, 'create', $menu->id) && $menu->alias == 'gallery')
                                                <li>
                                                    <a href="{{ site_url($menu->url.'/add') }}"><span class="fa fa-plus-circle"></span>Add</a>
                                                </li>
                                            @endif
                                            @if ($this->privileges_model->is(user()->id, 'read', $menu->id) && $menu->alias !== 'news')
                                            <li>
                                                <a href="{{ site_url($menu->url.'/mine') }}"><span class="fa fa-hand-pointer-o"></span>My {{ $menu->name }}</a>
                                            </li>
                                            @endif
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="menu_section">
                <h3>Settings</h3>
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-id-card-o"></i> Account
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ site_url('account/change-password') }}"><span class="fa fa-key"></span>Change Password</a>
                            </li>
                            <li>
                                <a href="{{ site_url('account/edit-profile') }}"><span class="fa fa-pencil"></span>Edit Profile</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ site_url('logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
<!-- /left navigation -->
<input id="urlRoomPendingCount" type="hidden" value="{{ site_url('rooms/renting/ajax_count_pending') }}">