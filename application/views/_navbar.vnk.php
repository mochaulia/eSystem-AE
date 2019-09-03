<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ images_base64(user()->avatar) }}" alt="">{{ user()->first_name }} {{ user()->last_name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="{{ site_url('account/edit-profile') }}">
                                <i class="fa fa-id-badge pull-right"></i>
                                {{ lang('top_user_profile') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ site_url('logout') }}">
                                <i class="fa fa-sign-out pull-right"></i>
                                {{ lang('top_user_logout') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span id="countUnreadMsg"></span>
                    </a>
                    <ul id="notifUnreadMsg" class="dropdown-menu list-unstyled msg_list" role="menu"></ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<input id="urlCountUnreadMsg" type="hidden" value="{{ site_url('messages/ajax_count_unread') }}">
<input id="urlNotifUnreadMsg" type="hidden" value="{{ site_url('messages/ajax_notif_unread') }}">
